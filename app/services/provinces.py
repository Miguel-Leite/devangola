import os
from flask import jsonify
from app.database.database import getDatabase

def provinces (app):

    @app.route("/provinces/<string:countrie>/<string:country>")
    def index(countrie,country):
        try:
            data = getDatabase()
            if (countrie in  data['countries'] and country in data['countries'][countrie]):    
                provinces = data['countries'][countrie][country]['provinces']
                return jsonify({"success": True,"provincies": provinces})
            else:
                return jsonify({"success": False,"message": "Countrie Or Country Not Found"})
        except Exception as e:
            return jsonify({"success": False,"message": "Internal Server Error"})
    
    @app.route("/provinces/<string:countrie>/<string:country>")
    def single():
        pass