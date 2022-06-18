# import pytest
# from .app import create_app


# @pytest.fixture()
# def App():
#     """Configures the app for testing

#     Sets app config variable ``TESTING`` to ``True``

#     :return: App for testing
#     """

#     #app.config['TESTING'] = True
#     app = create_app()
#     app.config.update({
#         "TESTING": True,
#     })

#     # other setup can go here

#     yield app

# @pytest.fixture()
# def Client(app):
#     return app.test_client()

# @pytest.fixture()
# def Runner(app):
#     return app.test_cli_runner()