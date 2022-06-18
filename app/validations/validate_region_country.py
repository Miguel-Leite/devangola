from app.database.database import getDatabase

data = getDatabase()

def verify_exists_countrie(countrie) -> bool:
    if (countrie not in  data['countries']):
        return False
    return True

def verify_exists_country(countrie,country) -> bool:
    if (country not in  data['countries'][countrie]):
        return False
    return True

def verify_exists_option(countrie,country,option) -> bool:
    if option in data['countries'][countrie][country]:
        return True
    return False