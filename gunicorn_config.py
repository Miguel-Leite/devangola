bind = "0.0.0.0:8000"
reload = True
workers = 2
threads = 4
timeout = 10
loglevel = 'debug'
accesslog = 'log/gunicorn/access_log.log'
errorlog =  'log/gunicorn/error_log.log'