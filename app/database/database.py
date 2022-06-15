import json

def getDatabase() -> object :
    with open("database.json",encoding='utf-8') as database_json:
        data = json.load(database_json)

    return data