import os
from flask import jsonify
from app.database.database import getDatabase
from app.validations.validate_provincy import verify_exists_countrie, verify_exists_country, verify_exists_provincy

def provinces (app):

    @app.route("/provinces/<string:countrie>/<string:country>")
    def get(countrie,country):
        try:
            data = getDatabase()
            if verify_exists_countrie(countrie) is False:
                return jsonify({"success": False,"message": "Countrie Not Found"})

            if verify_exists_country(countrie, country) is False:
                return jsonify({"success": False,"message": "Country Not Found"})

            provinces = data['countries'][countrie][country]['provinces']
            return jsonify({"success": True,"provincies": provinces})
        except Exception as e:
            return jsonify({"success": False,"message": "Internal Server Error"})
    
    @app.route("/provinces/<string:countrie>/<string:country>/<string:provincy>")
    def single(countrie,country,provincy):
        try:
            data = getDatabase()
            if verify_exists_provincy(countrie, country,provincy) is False:
                return jsonify({"success": False,"message": "Provincy Not Found"})
            find = data['countries'][countrie][country]['provinces'][provincy]
            return jsonify(find)
        except Exception as e:
            return jsonify({"success": False,"message": "Internal Server Error"})