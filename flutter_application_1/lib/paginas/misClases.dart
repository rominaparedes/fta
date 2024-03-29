import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

import 'package:flutter_application_1/main.dart';
import 'package:flutter_application_1/paginas/paginaPrincipal.dart';

class MisClases extends StatelessWidget {
  Future<List> busxAlumno() async {
    final response2 = await http.post(
        "http://192.168.43.61:8080/fta/app_flutter/getClasesporAlumno.php",
        body: {
          "id_alumno": rut.toString(),
        });
    var jsonBody2 = response2.body;
    var jsonData2 = json.decode(jsonBody2);
    print(jsonData2);
    return jsonData2;
  }

  @override
  Widget build(BuildContext context) {
    if (s == 'F') {
      return new Scaffold(
          appBar: AppBar(
            title: Text("Mis Clases"),
            backgroundColor: Colors.purple,
          ),
          body: new FutureBuilder<List>(
            future: busxAlumno(),
            builder: (context, snapshot) {
              if (snapshot.hasError) print(snapshot.error);
              return snapshot.hasData
                  ? new Card(
                      lista: snapshot.data,
                    )
                  : new Center(
                      child: new CircularProgressIndicator(),
                    );
            },
          ));
    } else {
      return new Scaffold(
          appBar: AppBar(
            title: Text("Mis Clases"),
            backgroundColor: Colors.red,
          ),
          body: new FutureBuilder<List>(
            future: busxAlumno(),
            builder: (context, snapshot) {
              if (snapshot.hasError) print(snapshot.error);
              return snapshot.hasData
                  ? new Card(
                      lista: snapshot.data,
                    )
                  : new Center(
                      child: new CircularProgressIndicator(),
                    );
            },
          ));
    }
  }
}

class Card extends StatelessWidget {
  final List lista;
  int pos;
  int r;
  Card(
      {this.lista,
      RoundedRectangleBorder shape,
      EdgeInsets margin,
      int elevation,
      Column child});

  @override
  Widget build(BuildContext context) {
    return new ListView.builder(
      itemCount: lista == null ? 0 : lista.length,
      itemBuilder: (context, posicion) {
        return new Container(
          padding: EdgeInsets.all(2.0),
          child: new GestureDetector(
            child: new RaisedButton(
              shape: new RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(10)),
              onPressed: () {},
              color: Colors.white,
              child: new Container(
                padding: EdgeInsets.all(15),
                child: Column(
                  children: <Widget>[
                    ListTile(
                      contentPadding: EdgeInsets.fromLTRB(15, 10, 25, 0),
                      title: Text(lista[posicion]["curso"]),
                      subtitle: Text(
                        lista[posicion]["profesor"] +
                            "\n" +
                            lista[posicion]["horas"],
                      ),
                      leading: Icon(Icons.check),
                    ),
                    Row(
                      mainAxisAlignment: MainAxisAlignment.end,
                    )
                  ],
                ),
              ),
            ),
          ),
        );
      },
    );
  }
}
