import json
import os

cwd = os. getcwd()
database = f'{cwd}/app/database/database.json'

def getDatabase() -> dict :
    with open(database,encoding='utf-8') as database_json:
        data = json.load(database_json)

    return data