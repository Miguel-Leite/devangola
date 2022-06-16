from app.database.database import getDatabase

data = getDatabase()

def verify_exists_countrie(countrie):
    if (countrie not in  data['countries']):
        return False
    return True

def verify_exists_country(countrie,country):
    if (country not in  data['countries'][countrie]):
        return False
    return True

def verify_exists_provincy(countrie,country,provincy):
    if (provincy not in  data['countries'][countrie][country]['provinces']):
        return False
    return True
