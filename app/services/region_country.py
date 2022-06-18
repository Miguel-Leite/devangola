import os
from flask import jsonify
from app.database.database import getDatabase
from app.validations.validate_region_country import verify_exists_countrie, verify_exists_country, verify_exists_option

def regionCountry (app):
    # exemple endpoint -> http://api.domain.com/african/angola/provinces
    @app.route("/<string:countrie>/<string:country>/<string:option>")
    def get(countrie,country,option):
        try:
            data = getDatabase()
            if verify_exists_countrie(countrie) is False:
                return jsonify({"success": False,"message": "Countrie Not Found"})

            if verify_exists_country(countrie, country) is False:
                return jsonify({"success": False,"message": "Country Not Found"})

            if verify_exists_option(countrie,country,option) is False:
                return jsonify({"success": False,"message": "Option Not Found"})

            data = data['countries'][countrie][country][option]
            return jsonify({"success": True,"data": data})
        except Exception as e:
            return jsonify({"success": False,"message": "Internal Server Error"})