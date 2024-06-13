from flask import Flask, render_template, request, redirect, url_for, session, jsonify
import pickle
import requests

app = Flask(__name__)
app.secret_key = '671-185-825'


class RuleBasedAI:
    def __init__(self):
        self.questions = [
            ("Have you had unprotected sex and with how many partners?", 3),
            ("Do you use intravenous drugs and have you ever shared needles?", 3),
            ("Have you or your partners been tested for HIV or other sexually transmitted infections?", 3),
            ("Do you suffer from persistent diarrhea?", 2),
            ("Have you experienced unexplained weight loss recently?", 2),
            ("Do you frequently experience fevers or night sweats?", 2),
            ("Have you had any severe infections or illness in the past few months?", 2),
            ("Have you noticed any lesions or unusual marks on your skin?", 2),
            ("Are you currently experiencing any mouth ulcers or thrush?", 2),
            ("Have you experienced prolonged lymph node swelling?", 2),
            ("Have you received any tattoos or piercings with non-sterilized equipment?", 2),
            ("Do you frequently feel fatigued or have a low energy level?", 2),
            ("Do you have a history of hepatitis or TB?", 2),
            ("Do you have a history of cancer, particularly cancer associated with weakened immune systems like Kaposi's sarcoma or lymphoma?", 2),
            ("Have you had a blood transfusion or organ transplant in the past?", 2),
            ("Have you noticed any changes in your cognitive abilities or neurological symptoms?", 2),
            ("Have you experienced any significant vision changes or eye infections?", 2),
            ("Do you have chronic cough or shortness of breath?", 2),
            ("Have you experienced any skin rashes or dermatitis?", 2),
            ("Have you been tested for HIV in the past, and what were the results?", 2),
            ("Do you experience frequent respiratory infections or pneumonia?", 2),
            ("Is there any family history of HIV?", 1),
            ("Have you experienced any unusual bleeding or bruising?", 1),
            ("When did you first begin to notice your symptoms?", 1),
            ("Have you experienced any joint or muscle pain?", 1),
            ("Do you have recurring headaches?", 1),
            ("Have you noticed any changes in your appetite?", 1),
            ("Have you traveled to or lived in an area with high HIV prevalence?", 1),
            ("Have you experienced any abdominal pain or discomfort?", 1),
            ("Have you had any unexplained changes in your menstrual cycle (for women)?", 1),
            ("Do you have any known allergies to medications or treatments?", 1),
            ("Have you experienced any mental health issues, such as depression or anxiety?", 1),
            ("Do you have any difficulty swallowing or chronic sore throat?", 2),
            ("Have you experienced any numbness or tingling in your hands or feet?", 1)
        ]

        self.threshold = 0.75
        self.score_threshold = sum([q[1] for q in self.questions]) * self.threshold
        self.score = 0
        self.user_answers = []

    def validate_answer(self, answer):
        return answer in ["yes", "no"]

    def process_answer(self, answer, weight):
        if answer == "yes":
            self.score += weight

    def calculate_risk_level(self):
        total_possible_score = sum([q[1] for q in self.questions])
        risk_percentage = (self.score / total_possible_score) * 100
        
        if risk_percentage >= 75:
            risk_level = "High Risk"
        elif risk_percentage >= 50:
            risk_level = "Moderate Risk"
        else:
            risk_level = "Low Risk"
            
        return risk_level, risk_percentage

    def suggest_lab_test(self):
        risk_level, risk_percentage = self.calculate_risk_level()
        if self.score >= self.score_threshold:
            return f"Based on your responses, you are at {risk_level} ({risk_percentage:.2f}%). It is recommended to consult a healthcare professional and consider getting a lab test."
        else:
            return f"Based on your responses, you are at {risk_level} ({risk_percentage:.2f}%). It is not recommended to undergo a lab test at this time. However, if your symptoms persist or worsen, please consult a healthcare professional."


def save_ai_to_session(ai):
    session['ai'] = pickle.dumps(ai)


def load_ai_from_session():
    return pickle.loads(session['ai'])


@app.route('/')
def index():
    if 'user' in session:
        return render_template('index.html')
    else:
        return redirect(url_for('register'))


@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        firstname = request.form.get('firstname')
        lastname = request.form.get('lastname')
        username = request.form.get('username')
        address = request.form.get('address')
        age = request.form.get('age')
        gender = request.form.get('gender')
        phone = request.form.get('phone')
        password = request.form.get('password')
        password2 = request.form.get('password2')
        creater = request.form.get('creater')

        if password != password2:
            return render_template('register.php', error="Passwords do not match")

        # Save user to session
        session['user'] = username

        # Send form data to PHP script
        data = {
            'firstname': firstname,
            'lastname': lastname,
            'username': username,
            'address': address,
            'gender': gender,
            'age': age,
            'phone': phone,
            'password': password,
            'creater': creater
        }
        response = requests.post('http://localhost/flask_App/templates/save/save_user.php', json=data)
        if response.status_code == 200:
            return redirect(url_for('index'))
        else:
            return render_template('register.php', error="Failed to register. Please try again.")

    return render_template('register.php')


@app.route('/start', methods=['POST', 'GET'])
def start():
    if request.method == 'POST':
        ai = RuleBasedAI()
        save_ai_to_session(ai)
        session['user_answers'] = []
        return redirect(url_for('question', q=0))
    return render_template('start.html')


@app.route('/question/<int:q>', methods=['GET', 'POST'])
def question(q):
    if 'ai' not in session:
        return redirect(url_for('index'))

    ai = load_ai_from_session()

    if request.method == 'POST':
        answer = request.form.get('answer')
        if ai.validate_answer(answer):
            session['user_answers'].append((ai.questions[q-1][0], answer))
            ai.process_answer(answer, ai.questions[q-1][1])
            save_ai_to_session(ai)
        else:
            return render_template('question.html', question=ai.questions[q][0], error="Please answer with 'yes' or 'no'.")
        return redirect(url_for('question', q=q+1))

    if q >= len(ai.questions):
        ai.user_answers = session['user_answers']
        result = ai.suggest_lab_test()
        risk_level, risk_percentage = ai.calculate_risk_level()
        data = {
            'username': session['user'],
            'answers': session['user_answers'],
            'result': result,
            'risk_level': risk_level,
            'risk_percentage': risk_percentage
        }

        response = requests.post('http://localhost/flask_App/templates/save/save_answers.php', json=data)
        print(response.text)

        rendered_result = render_template('result.html', result=result, risk_level=risk_level, risk_percentage=risk_percentage)
        session.clear()
        return rendered_result

    return render_template('question.html', question=ai.questions[q][0])


if __name__ == "__main__":
    app.run(debug=True)
