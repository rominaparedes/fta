import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_application_1/main.dart';
import 'package:flutter_application_1/paginas/paginaPrincipal.dart';
import 'package:http/http.dart' as http;

class ClasesDisponiblesxDia extends StatelessWidget {
  String tmpArray = "";
  ClasesDisponiblesxDia(this.tmpArray);

  Future<List> busxdia() async {
    print(tmpArray);
    final response3 = await http.post(
        "http://192.168.43.61:8080/fta/app_flutter/getClasesDisponiblesxdia.php",
        headers: {
          "Accept": "application/json"
        },
        body: {
          "id_dias_sel": tmpArray,
        });

    print("response" + response3.body);

    var jsonBody3 = response3.body;
    var jsonData3 = json.decode(jsonBody3);

    return jsonData3;
  }

  Widget build(BuildContext context) {
    if (s == 'F') {
      return new Scaffold(
        appBar: AppBar(
          title: Text("Listado de Horarios por Dia"),
          backgroundColor: Colors.purple,
        ),
        body: new FutureBuilder<List>(
          future: busxdia(),
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
          title: Text("Listado de Horarios por Dia"),
          backgroundColor: Colors.red,
        ),
        body: new FutureBuilder<List>(
          future: busxdia(),
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
  int r;
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
                                  new MaterialPageRoute(
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
                                  new MaterialPageRoute(
                                      builder: (context) => Principal()),
                                );
                              },
                            )
                          ],
                        );
                      });
                },
                color: Colors.deepOrangeAccent,
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
    }
  }
}
