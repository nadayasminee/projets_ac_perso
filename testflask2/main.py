import openai
from flask import Flask, render_template, request

openai.api_key = ""
app = Flask(__name__)

@app.route("/", methods=['POST', 'GET'])
def index():
    if request.method == 'POST':
        donnees = request.form
        prompt = donnees.get('prompt')

        
        response = openai.Image.create(
            prompt=prompt,
            size="512x512",
            n=1
        )

        image_url = response['data'][0]['url']
        return render_template("index.html", image_url=image_url)
    
    return render_template("index.html")
