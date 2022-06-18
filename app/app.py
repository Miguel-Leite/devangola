import os
from flask import Flask, jsonify

from .services.region_country import regionCountry

def create_app():
    app = Flask(__name__)

    @app.route("/")
    def index():
        return jsonify({
            "API": "DEV ANGOLA",
            "DEVELOPER": {
                "NAME": ["Miguel Leite"],
                "TITLE": ["FULLSTACK DEVELOPER"],
                "AGE": [21],
                "RESIDENCY": ["Angola, Luanda"],
                "NATIONALITY": ["Angolana"],
                "CONTACT": ["941398739","951184314"], 
                "SOCIAL": {
                    "WhatsApp": ["941398739"],
                },
                "SITES": {
                    "Github": ["https://github.com/Miguel-Leite"],
                }
            },
            "CONTRIBUIDORES": [],
        })
    
    """ ROUTER FOR REGION OF COUNTRY """
    regionCountry(app)

    return app