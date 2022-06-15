FROM python:3.7-slim

ENV CONTAINER_HOME=/var/www

ADD . ${CONTAINER_HOME}
WORKDIR ${CONTAINER_HOME}

COPY requirements.txt .

RUN pip install --upgrade pip
RUN pip install -r ${CONTAINER_HOME}/requirements.txt

# CMD [ "gunicorn", "--bind", "0.0.0.0:8080", "--workers 4",  "app.app:create_app()" ]