from flask import Flask, redirect,render_template, request, session, url_for
import datetime

app=Flask(__name__)
app.secret_key = 'b18bc9e558b4072ee859a89706ba33534e070b1cc1cf91cd6188c60e9c984419'


@app.route("/")
def bonjour():
    return render_template("index.html")

@app.route("/question1")
def question1():
    return render_template("question1.html")

@app.route("/traitement_question1", methods=["POST"])
def traitement_question1():
    reponse = request.form.get("q1")
    
    
    if reponse == "B":
        session['score'] += 1
    return redirect(url_for('question2'))


@app.route("/question2")
def question2():
    return render_template("question2.html")

@app.route("/traitement_question2", methods=["POST"])
def traitement_question2():
    reponse = request.form.get("q2")
    
    if reponse == "C":  
        session['score'] += 1
   
    return redirect(url_for('question3'))



@app.route("/question3")
def question3():
    return render_template("question3.html")

@app.route("/traitement_question3", methods=["POST"])
def traitement_question3():
    reponse = request.form.get("q3")
    
    if reponse == "C":  
        session['score'] += 1
    
    return redirect(url_for('question4'))

@app.route("/question4")
def question4():
    return render_template("question4.html")

@app.route("/traitement_question4", methods=["POST"])
def traitement_question4():
    reponse = request.form.get("q4")
    
    if reponse == "B":  
        session['score'] += 1
    
    return redirect(url_for('question5'))

@app.route("/question5")
def question5():
    return render_template("question5.html")

@app.route("/traitement_question5", methods=["POST"])
def traitement_question5():
    reponse = request.form.get("q5")
    
    if reponse == "C":  
        session['score'] += 1
    
    return redirect(url_for('resultat_final'))

@app.route("/resultat_final")
def resultat_final():
    score_total = session.get('score', 0)
    nombre_questions =5
    moyenne = (score_total / nombre_questions) * 100
    nom=session.get('nom','Player')
    print(nombre_questions)
    if moyenne == 100:
        message = f"Congratulations {nom}! Pole Position! You manifested the Max Verstappen in you."
    elif moyenne >= 75:
        message = f"Great job, {nom}! So close to P1! The strategy failed you this time but you got a podium."
    elif moyenne >= 50:
        message = f"Not bad, {nom}! You're in the points, but still need a few more laps to master F1."
    else:
        message = f"Blue flag, {nom}! Time to head back to the pits and review your F1 knowledge."

    
    return render_template("resultat.html", score=score_total, moyenne=moyenne, message=message)




@app.route("/traitement", methods=["POST"])
def traitement():
    donnees=request.form
    nom=donnees.get('nom')
    session['nom']=nom
    session['score'] = 0
    session['questions'] = 1
    return redirect(url_for('question1'))

if __name__=='__main__':
    app.run(debug=True)