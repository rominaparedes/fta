import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:intl/intl.dart';
import 'package:flutter_application_1/main.dart';
import 'package:flutter_application_1/paginas/misClases.dart';
import 'package:flutter_application_1/paginas/cupos.dart';
import 'package:flutter_application_1/paginas/paginaClasesDisponiblesxDia.dart';
import 'package:flutter_application_1/paginas/paginaClasesDisponibles.dart';

String tmpArray = "";

class Principal extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    final arguments = ModalRoute.of(context).settings.arguments as Map;

    return MaterialApp(
      home: Scaffold(
          appBar: AppBar(
            title: Text('Bienvenida ' + arguments['nombre']),
            backgroundColor: Colors.purple,
          ),
          drawer: MenuLateral(),
          body: SafeArea(
              child: Center(
            child: Radiobutton(),
          ))),
    );
  }
}

class MenuLateral extends StatelessWidget {
  @override
  Widget build(BuildContext ctxt) {
    return new Drawer(
      child: ListView(
        children: <Widget>[
          DrawerHeader(
              decoration: BoxDecoration(
                  gradient: LinearGradient(
                      colors: <Color>[Colors.purple, Colors.purple])),
              child: Container(
                child: Column(
                  children: <Widget>[
                    Material(
                      elevation: 10,
                      child: Padding(
                        padding: EdgeInsets.all(8.0),
                        child: Image.asset("assets/images/img_pequeña_fta.png",
                            height: 90, width: 90),
                      ),
                    ),
                    Text(
                      'Mis Clases',
                      style: TextStyle(color: Colors.white, fontSize: 15.0),
                    )
                  ],
                ),
              )),
          CustomListTile(
              Icons.person,
              'Clases Reservadas',
              () => {
                    Navigator.pop(ctxt),
                    Navigator.push(
                        ctxt,
                        new MaterialPageRoute(
                            builder: (context) => MisClases()))
                  }),
          CustomListTile(
              Icons.notifications,
              'Cupos',
              () => {
                    Navigator.pop(ctxt),
                    Navigator.push(ctxt,
                        new MaterialPageRoute(builder: (context) => Cupos()))
                  }),
          CustomListTile(
              Icons.logout,
              'Cerra Session',
              () => {
                    Navigator.pop(ctxt),
                    Navigator.push(ctxt,
                        new MaterialPageRoute(builder: (context) => LoginApp()))
                  })
        ],
      ),
    );
  }
}

class CustomListTile extends StatelessWidget {
  final IconData icon;
  final String text;
  final Function onTap;

  CustomListTile(this.icon, this.text, this.onTap);
  @override
  Widget build(BuildContext context) {
    //ToDO
    return Padding(
      padding: const EdgeInsets.fromLTRB(8.0, 0, 8.0, 0),
      child: Container(
        decoration: BoxDecoration(
            border: Border(bottom: BorderSide(color: Colors.grey.shade400))),
        child: InkWell(
            splashColor: Colors.orangeAccent,
            onTap: onTap,
            child: Container(
                height: 40,
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: <Widget>[
                    Row(
                      children: <Widget>[
                        Icon(icon),
                        Padding(
                          padding: const EdgeInsets.all(8.0),
                        ),
                        Text(
                          text,
                          style: TextStyle(fontSize: 16),
                        ),
                      ],
                    ),
                    Icon(Icons.arrow_right)
                  ],
                ))),
      ),
    );
  }
}

class Radiobutton extends StatefulWidget {
  @override
  RadioButtonWidget createState() => RadioButtonWidget();
}

class RadioButtonWidget extends State {
  String radioItem = '';

  Map<String, bool> values = {
    "Lunes": false,
    "Martes": false,
    "Miercoles": false,
    "Jueves": false,
    "Viernes": false,
    "Sabado": false,
    "Domingo": false,
  };

  getCheckboxItems() {
    tmpArray = "";
    values.forEach((key, value) {
      if (value == true) {
        //if (tmpArray.length == 0) {
        //tmpArray = tmpArray;
        //} else {
        tmpArray = tmpArray + "," + key;
        //}
      }
    });
    // Printing all selected items on Terminal screen.
    return tmpArray;
    // Here you will get all your selected Checkbox items.

    // Clear array after use.
    //tmpArray.clear();
  }

  String mensaje = '';
  TextEditingController controllerBusq = new TextEditingController();
  String selectedClase;
  List data = List();
  List data2 = List();

  //var jsonData2;

  Future getAllName() async {
    var response = await http.get(
        "http://192.168.43.61:8080/fta/app_flutter/obtenerCursosActivos.php",
        headers: {"Accept": "application/json"});
    var jsonBody = response.body;
    var jsonData = json.decode(jsonBody);

    setState(() {
      data = jsonData;
    });
    print(jsonData);
  }

  @override
  void initState() {
    super.initState();
    getAllName();
  }

  /*Future<List> busqueda() async {
    final response = await http.post(
        "http://192.168.43.61:8080/fta/app_flutter/getClasesDisponibles.php",
        body: {
          "id_curso_sel": controllerBusq.text,
        });

    print("response" + response.body);

    var datauser = json.decode(response.body);
    if (datauser.length == 0) {
      setState(() {
        mensaje = "usuario incorrecto";
      });
    } else {
      if (datauser[0]['NOM_PERFIL'] == 'ADMIN') {
        Navigator.pushReplacementNamed(context, '/paginaPrincipal');
      } else if (datauser[0]['NOM_PERFIL'] == 'ALUMNO') {
        Navigator.pushReplacementNamed(context, '/paginaClasesDisponibles');
      }
      setState(() {
        username = datauser[0]['NOM_PERFIL'];
      });
    }
    return datauser;
  }*/

  Widget build(BuildContext context) {
    return Column(
      children: <Widget>[
        Text('\nSelecciona opción para realizar búsqueda de cursos\n'),
        RadioListTile(
          groupValue: radioItem,
          title: Text('Curso'),
          value: 't',
          onChanged: (val) {
            setState(() {
              radioItem = val;
            });
          },
        ),
        RadioListTile(
          groupValue: radioItem,
          title: Text('Fecha'),
          value: 'f',
          onChanged: (val) {
            setState(() {
              radioItem = val;
            });
          },
        ),
        radioItem == 't'
            ? Column(children: [
                DropdownButton(
                  value: selectedClase,
                  items: data.map(
                    (list) {
                      return DropdownMenuItem(
                          child: Text(list["NOMBRE_CURSO"]),
                          value: list["ID_CURSO"].toString());
                    },
                  ).toList(),
                  onChanged: (value) {
                    setState(() {
                      selectedClase = value; //funciona
                      //print(selectedClase);
                    });
                  },
                ),
              ])
            : radioItem == 'f'
                ? Expanded(
                    child: ListView(
                      children: values.keys.map((String key) {
                        return new CheckboxListTile(
                          title: new Text(key),
                          value: values[key],
                          activeColor: Colors.pink,
                          checkColor: Colors.white,
                          onChanged: (bool value) {
                            setState(() {
                              values[key] = value;
                            });
                          },
                        );
                      }).toList(),
                    ),
                  )
                : Text(''),
        RaisedButton(
            child: new Text("Buscar",
                style: TextStyle(
                    fontWeight: FontWeight.bold, color: Colors.white)),
            color: Colors.deepPurple,
            shape: new RoundedRectangleBorder(
                borderRadius: new BorderRadius.circular(30.0)),
            onPressed: () {
              if (radioItem == "t") {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                      builder: (context) => ClasesDisponibles(selectedClase)),
                );
              } else {
                getCheckboxItems();
                Navigator.push(
                  context,
                  MaterialPageRoute(
                      builder: (context) =>
                          ClasesDisponiblesxDia(tmpArray.toString())),
                );
              }
            })
      ],
    );
  }
}
