import os
from flask import Flask, jsonify

from .services.provinces import provinces

def create_app():
    app = Flask(__name__)

    @app.route("/")
    def index():
        return jsonify({
            "API": "DEV ANGOLA",
            "DEVELOPER": {
                "ABOUT": ["""
                    Chamo-me Miguel Pascoal Alfredo Leite, estudante do INSTITUTO POLITÉCNICO
PRIVADO ANHERC no curso de Técnico Informático. Sou apaixonado pelas tecnologias,
comecei a programar desde 2018 quando eu estava a fazer o meu primeiro ano do
ensino médio.
Durante o meu aprendizado, as primeiras tecnologias que eu aprende são: HTML / CSS e
JAVASCRIPT depois de 2 meses passei a estudar C# porque era umas das tecnologias
que eu estava a aprender no instituto, porém como o meu foco era
aprender programação web, eu passei a me dedica mas na programação web (HTML,
CSS, JAVASCRIPT) porque na aquela altura eu quis apenas ser desenvolvedor web front-
end. Depois de alguns tempo eu passei a estudar a linguagem de programação PHP,
porque eu tinha que desenvolver uma página dinâmica para apresentar na atividade do
instituto, e daí comecei a ganhar interesse em ser um desenvolvedor web back-end e
passei a estudar bastante o PHP com seus framework(Laravel, Codeigniter).
Porém não me limitei apenas no PHP fui aprender também a linguagem de
programação Python entre outras as tecnologias assim como faço até hoje, ir buscar
novos conhecimentos.
                """],
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
    
    """ ROUTER FOR PROVINCES """
    provinces(app)

    return app