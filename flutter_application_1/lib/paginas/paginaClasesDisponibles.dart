import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_application_1/paginas/paginaPrincipal.dart';
import 'package:http/http.dart' as http;

import 'package:flutter_application_1/main.dart';

//List data2 = List();
//var dias = "";

class ClasesDisponibles extends StatelessWidget {
  final String selectedClase;
  const ClasesDisponibles(this.selectedClase, {Key key}) : super(key: key);

  Future<List> bus() async {
    final response2 = await http.post(
        "http://192.168.43.61:8080/fta/app_flutter/getClasesDisponibles.php",
        body: {
          "id_curso_sel": selectedClase,
        });
    var jsonBody2 = response2.body;
    var jsonData2 = json.decode(jsonBody2);

    /*setState(() {
      data2 = jsonData2;
    });*/
    print(jsonData2);
    return jsonData2;
  }

  Widget build(BuildContext context) {
    if (s == 'F') {
      return new Scaffold(
        appBar: AppBar(
          title: Text("Listado de Horarios"),
          backgroundColor: Colors.purple,
        ),
        body: new FutureBuilder<List>(
          future: bus(),
          builder: (context, snapshot) {
            if (snapshot.hasError) print(snapshot.error);
            return snapshot.hasData
                ? new ElementoLista(
                    lista: snapshot.data,
                  )
                : new Center(
                    child: new CircularProgressIndicator(),
                  );
          },
        ),
      );
    } else {
      return new Scaffold(
        appBar: AppBar(
          title: Text("Listado de Horarios"),
          backgroundColor: Colors.red,
        ),
        body: new FutureBuilder<List>(
          future: bus(),
          builder: (context, snapshot) {
            if (snapshot.hasError) print(snapshot.error);
            return snapshot.hasData
                ? new ElementoLista(
                    lista: snapshot.data,
                  )
                : new Center(
                    child: new CircularProgressIndicator(),
                  );
          },
        ),
      );
    }
  }
}

class ElementoLista extends StatelessWidget {
  final List lista;
  int pos;
  ElementoLista({this.lista});

  void grabar() async {
    var response4 = await http.post(
        "http://192.168.43.61:8080/fta/app_flutter/gbRelacionAlumnoHorario.php",
        body: {
          "id_horario": lista[pos]["id"].toString(),
          "id_alumno": rut.toString(),
        });
    /*var jsonBody4 = response4.body;
  var jsonData4 = json.decode(jsonBody4);
  if (jsonData4 == 'grabado') {
    r = 1;
  } else {
    r = 0;
    
  }*/
    //print(jsonData4);
    /*setState(() {
    data2 = jsonData2;
  });*/

    //print(jsonData4);
    //return r;
  }

  @override
  Widget build(BuildContext context) {
    if (s == 'F') {
      if (lista.length > 0) {
        return new ListView.builder(
          itemCount: lista == null ? 0 : lista.length,
          itemBuilder: (context, posicion) {
            return new Container(
              padding: EdgeInsets.all(2.0),
              child: new GestureDetector(
                child: new RaisedButton(
                  shape: new RoundedRectangleBorder(
                      borderRadius: new BorderRadius.circular(30.0)),
                  onPressed: () {
                    pos = posicion;
                    grabar();
                    showDialog(
                        context: context,
                        builder: (BuildContext context) {
                          return AlertDialog(
                            title: Text("Ingreso Correcto"),
                            actions: <Widget>[
                              FlatButton(
                                child: Text("OK"),
                                onPressed: () {
                                  Navigator.push(
                                    context,
                                    MaterialPageRoute(
                                        builder: (context) => Principal()),
                                  );
                                },
                              )
                            ],
                          );
                        });
                  },
                  color: Colors.deepPurple,
                  child: new Container(
                    padding: EdgeInsets.all(10.0),
                    child: Text(
                      lista[posicion]["horas"],
                      style: TextStyle(
                          fontWeight: FontWeight.bold, color: Colors.white),
                    ),
                  ),
                ),
              ),
            );
          },
        );
      } else {
        return new Container(
          padding: EdgeInsets.all(10.0),
          child: new GestureDetector(
            child: new RaisedButton(
              shape: new RoundedRectangleBorder(
                  borderRadius: new BorderRadius.circular(30.0)),
              onPressed: () {},
              color: Colors.deepPurple,
              child: new Container(
                padding: EdgeInsets.all(10.0),
                child: Text(
                  "Este curso ya lo tienes reservado¡",
                  style: TextStyle(
                      fontWeight: FontWeight.bold, color: Colors.white),
                ),
              ),
            ),
          ),
        );
      }
    } else {
      print(lista.length);
      if (lista.length > 0) {
        return new ListView.builder(
          itemCount: lista == null ? 0 : lista.length,
          itemBuilder: (context, posicion) {
            return new Container(
              padding: EdgeInsets.all(2.0),
              child: new GestureDetector(
                child: new RaisedButton(
                  shape: new RoundedRectangleBorder(
                      borderRadius: new BorderRadius.circular(30.0)),
                  onPressed: () {
                    pos = posicion;
                    grabar();
                    showDialog(
                        context: context,
                        builder: (BuildContext context) {
                          return AlertDialog(
                            title: Text("Ingreso Correcto"),
                            actions: <Widget>[
                              FlatButton(
                                child: Text("OK"),
                                onPressed: () {
                                  Navigator.push(
                                    context,
                                    MaterialPageRoute(
                                        builder: (context) => Principal()),
                                  );
                                },
                              )
                            ],
                          );
                        });
                  },
                  color: Colors.red,
                  child: new Container(
                    padding: EdgeInsets.all(10.0),
                    child: Text(
                      lista[posicion]["horas"],
                      style: TextStyle(
                          fontWeight: FontWeight.bold, color: Colors.white),
                    ),
                  ),
                ),
              ),
            );
          },
        );
      } else {
        return new Container(
          padding: EdgeInsets.all(10.0),
          child: new GestureDetector(
            child: new RaisedButton(
              shape: new RoundedRectangleBorder(
                  borderRadius: new BorderRadius.circular(30.0)),
              onPressed: () {},
              color: Colors.red,
              child: new Container(
                padding: EdgeInsets.all(10.0),
                child: Text(
                  "Este curso ya lo tienes reservado¡",
                  style: TextStyle(
                      fontWeight: FontWeight.bold, color: Colors.white),
                ),
              ),
            ),
          ),
        );
      }
    }
  }
}
