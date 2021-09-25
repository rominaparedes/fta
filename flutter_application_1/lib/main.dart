import 'dart:convert';
import 'dart:io';

import 'package:flutter/material.dart';
import 'package:flutter_application_1/paginas/paginaPrincipal.dart';
import 'package:http/http.dart' as http;

String rut = "";

TextEditingController controllerUser = new TextEditingController();
TextEditingController controllerPass = new TextEditingController();

void main() => runApp(LoginApp());

String username;
String saludo = "";

class LoginApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
        debugShowCheckedModeBanner: false,
        title: 'Flutter',
        home: LoginPage(),
        routes: <String, WidgetBuilder>{
          '/paginaPrincipal': (BuildContext context) => new Principal(),
          /*todas las paginas*/
          '/LoginPage': (BuildContext context) => new LoginPage(),
        });
  }
}

class LoginPage extends StatefulWidget {
  _LoginPageState createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  /*bool _isObscure = true;
  final _namefocusNode = FocusNode();
  final _pwfocusNode = FocusNode();
  final _nameController = TextEditingController();
  final _pwController = TextEditingController();*/

  String mensaje = '';

  Future<List> login() async {
    final response = await http
        .post("http://192.168.43.61:8080/fta/app_flutter/login.php", body: {
      "rut": controllerUser.text.toString(),
      "pass": controllerPass.text.toString(),
    });

    var datauser = json.decode(response.body);

    if (datauser.length == 0) {
      setState(() {
        mensaje = "usuario o contraseña incorrecta";
      });
    } else {
      //if (datauser[0]["nivel"] == "admin") {
      //Navigator.pushReplacementNamed(context, "/paginaPrincipal");
      Navigator.of(context)
          .pushNamed('/paginaPrincipal', arguments: <String, String>{
        'nombre': datauser[0]["NOMBRE_PERSONA"] + '-' + datauser[0]["SEXO"],
        'rut': datauser[0]["RUT"] /*,
        'sexo': datauser[0]["SEXO"]*/
      });
      //} else if (datauser[0]["nivel"] == "ventas") {
      //Navigator.pushReplacement(context, "/paginaPrincipal");
      //}
      /*setState(() {
        username = datauser[0]["username"];
      });*/
    }
    return datauser;
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      resizeToAvoidBottomPadding: false,
      body: Form(
        child: Container(
          decoration: new BoxDecoration(
            image: new DecorationImage(
                image: new AssetImage("assets/images/img_pequeña_fta.png"),
                fit: BoxFit.cover),
          ),
          child: Column(
            children: <Widget>[
              Container(
                height: MediaQuery.of(context).size.height / 2,
                width: MediaQuery.of(context).size.width,
                padding: EdgeInsets.only(top: 93),
                child: Column(
                  children: <Widget>[
                    Container(
                      width: MediaQuery.of(context).size.width / 1.2,
                      padding: EdgeInsets.only(
                          top: 4, left: 16, right: 16, bottom: 4),
                      decoration: BoxDecoration(
                          borderRadius: BorderRadius.all(Radius.circular(50)),
                          color: Colors.white,
                          boxShadow: [
                            BoxShadow(color: Colors.black12, blurRadius: 5)
                          ]),
                      child: TextField(
                        //focusNode: _namefocusNode,
                        controller: controllerUser,
                        decoration: InputDecoration(
                            icon: Icon(
                              Icons.email,
                              color: Colors.black,
                            ),
                            hintText: "Usuario"),
                      ),
                    ),
                    Container(
                      width: MediaQuery.of(context).size.width / 1.2,
                      height: 50,
                      margin: EdgeInsets.only(top: 32),
                      padding: EdgeInsets.only(
                          top: 4, left: 16, right: 16, bottom: 4),
                      decoration: BoxDecoration(
                          borderRadius: BorderRadius.all(Radius.circular(50)),
                          color: Colors.white,
                          boxShadow: [
                            BoxShadow(color: Colors.black12, blurRadius: 5)
                          ]),
                      child: TextField(
                        controller: controllerPass,
                        obscureText: true,
                        decoration: InputDecoration(
                            icon: Icon(
                              Icons.vpn_key,
                              color: Colors.black,
                            ),
                            hintText: "Password"),
                      ),
                    ),
                    /*Align(
                      alignment: Alignment.centerRight,
                      child: Padding(
                        padding: const EdgeInsets.only(top: 6, right: 32),
                        child: Text(
                          "Recordar Pass",
                          style: TextStyle(
                            color: Colors.grey,
                          ),
                        ),
                      ),
                    ),*/
                    Spacer(),
                    new RaisedButton(
                      child: new Text("Ingresar"),
                      color: Colors.orangeAccent,
                      shape: new RoundedRectangleBorder(
                          borderRadius: new BorderRadius.circular(30.0)),
                      onPressed: () {
                        login();
                        Navigator.pop(context);
                      },
                    ),
                    Text(
                      mensaje,
                      style: TextStyle(fontSize: 25.0, color: Colors.red),
                    )
                  ],
                ),
              )
            ],
          ),
        ),
      ),
    );
  }
}
