<?php 



class Clases
{
	private $id;
	private $fcDesde;
	private $fcHasta;
	private $hrDesde;
	private $hrHasta;
	private $lunes;
	private $martes;
	private $miercoles;
	private $jueves;
	private $viernes;
	private $sabado;
	private $domingo;
	private $cupos;
	private $curso;

	
	function __construct($id,$fcDesde,$fcHasta,$hrDesde,$hrHasta,$lunes,$martes,$miercoles,$jueves,$viernes,$sabado,$domingo,$cupos,$curso)
	{
		$this->setId($id);
		$this->setfcDesde($fcDesde);
		$this->setfcHasta($fcHasta);
		$this->sethrDesde($hrDesde);	
		$this->sethrHasta($hrHasta);
		$this->setLunes($lunes);	
		$this->setMartes($martes);
		$this->setMiercoles($miercoles);
		$this->setJueves($jueves);
		$this->setViernes($viernes);
		$this->setSabado($sabado);
		$this->setDomingo($domingo);
		$this->setCupos($cupos);
		$this->setCurso($curso);			
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getfcDesde(){
		return $this->fcDesde;
	}

	public function setfcDesde($fcDesde){
		$this->fcDesde = $fcDesde;
	}


	public function getfcHasta(){
		return $this->fcHasta;
	}

	public function setfcHasta($fcHasta){
		$this->fcHasta = $fcHasta;
	}
	
	public function gethrDesde(){
		return $this->hrDesde;
	}

	public function sethrDesde($hrDesde){
		$this->hrDesde = $hrDesde;
	}
	
	public function gethrHasta(){
		return $this->hrHasta;
	}

	public function sethrHasta($hrHasta){
		$this->hrHasta = $hrHasta;
	}
	
	public function getLunes(){
		return $this->lunes;
	}

	public function setLunes($lunes){
		$this->lunes = $lunes;
	}
	
	public function getMartes(){
		return $this->martes;
	}

	public function setMartes($martes){
		$this->martes = $martes;
	}
	
	public function getMiercoles(){
		return $this->miercoles;
	}

	public function setMiercoles($miercoles){
		$this->miercoles = $miercoles;
	}
	
	public function getJueves(){
		return $this->jueves;
	}

	public function setJueves($jueves){
		$this->jueves = $jueves;
	}
	
	public function getViernes(){
		return $this->viernes;
	}

	public function setViernes($viernes){
		$this->viernes = $viernes;
	}
	
	public function getSabado(){
		return $this->sabado;
	}

	public function setSabado($sabado){
		$this->sabado = $sabado;
	}
	
	public function getDomingo(){
		return $this->domingo;
	}

	public function setDomingo($domingo){
		$this->domingo = $domingo;
	}

	
 	public function getCupos(){
		return $this->cupos;
	}

	public function setCupos($cupos){
		$this->cupos = $cupos;
	} 
	
	public function getCurso(){
		return $this->curso;
	}

	public function setCurso($curso){
		$this->curso = $curso;
	}
	


	public static function guardarClase($clases){
		
		$db=Db::getConnect();
		$resp=1;
		$insert=$db->prepare("INSERT INTO horario VALUES (NULL,:hrDesde,:hrHasta,:fcDesde,:fcHasta,:curso,'A',:lunes,:martes,:miercoles,:jueves,:viernes,:sabado,:domingo,:cupos,0,12345,'12/12/2020','18:00', null, null,null)");
		$insert->bindValue('fcDesde',$clases->getfcDesde());
		$insert->bindValue('fcHasta',$clases->getfcHasta());
		$insert->bindValue('hrDesde',$clases->gethrDesde());
		$insert->bindValue('hrHasta',$clases->gethrHasta());
		$insert->bindValue('cupos',$clases->getCupos());
		$insert->bindValue('lunes',$clases->getLunes());
		$insert->bindValue('martes',$clases->getMartes());
		$insert->bindValue('miercoles',$clases->getMiercoles());
		$insert->bindValue('jueves',$clases->getJueves());
		$insert->bindValue('viernes',$clases->getViernes());
		$insert->bindValue('sabado',$clases->getSabado());
		$insert->bindValue('domingo',$clases->getDomingo());
		$insert->bindValue('curso',$clases->getCurso());
		$insert->execute();
		
		return $resp;
	}
	
	public static function guardarAsigna($idHora,$id_curso,$id_profesor){
		$db=Db::getConnect();
		$insert=$db->prepare("INSERT INTO horario_profesor VALUES ($idHora,$id_profesor,$id_curso)");
		$insert->execute();
	}


	public static function buscaClases(){
		
		$db=Db::getConnect();
		$clases;
		$select=$db->query("SELECT NOMBRE_CURSO, ID_CURSO FROM curso WHERE ESTADO_CURSO = 'A'");
		$clases = $select->fetchAll();
		return $clases;
	}
	
	public static function buscaDetAsis(){
		
		$db=Db::getConnect();
		$asis;
		$select=$db->query("SELECT 
								A.RUT_PERSONA,
								concat (C.NOMBRE_PERSONA, ' ',
								C.AP_PATERNO_PERSONA, ' ',
								C.AP_MATERNO_PERSONA) NOMBRE_PERSONA,
								A.CANTIDAD_CLASES,
								A.ID_CURSO,
								D.NOMBRE_CURSO,
								COUNT(B.RUT_PERSONA) AS ASISTIDAS
							FROM 
								boleta_alumno A ,
								reserva_cupo_clase B,
								persona C,
								curso D
							WHERE 
								A.RUT_PERSONA=B.RUT_PERSONA AND
								A.RUT_PERSONA = C.RUT_PERSONA AND
								A.ID_CURSO = D.ID_CURSO AND
								YEAR(CURDATE()) = YEAR(FECHA_RESERVA) AND
								MONTH(CURDATE()) = MONTH(FECHA_RESERVA)
							GROUP BY A.RUT_PERSONA,C.NOMBRE_PERSONA, C.AP_PATERNO_PERSONA,C.AP_MATERNO_PERSONA,A.CANTIDAD_CLASES, A.ID_CURSO, D.NOMBRE_CURSO ORDER BY A.CANTIDAD_CLASES" );
		$asis = $select->fetchAll();
		return $asis;
	}
	
	public static function buscaReservas($curso,$fecha,$hora){
		$db=Db::getConnect();
		$reservas;
		$select=$db->query("SELECT 
		DATE_FORMAT(B.FECHA_RESERVA,'%d-%m-%Y') AS FECHA, 
		C.HR_INICIO AS INICIO, 
		C.HR_FIN AS TERMINO, 
		B.ESTADO_RESERVA AS ESTADO, 
		D.NOM_PROFESOR AS PROFE,
		B.ID_HORARIO AS ID_HORARIO,
		B.ID_RESERVA AS ID_R,
		(SELECT COUNT(E.ID_RESERVA) FROM RESERVA_CUPO_CLASE E WHERE E.FECHA_RESERVA = '$fecha'  AND E.ESTADO_RESERVA = 'V' AND E.ID_CURSO = $curso) AS CUPOS_VAN,
		(SELECT C.CUPOS - COUNT(E.ID_RESERVA) FROM RESERVA_CUPO_CLASE E WHERE E.FECHA_RESERVA = '$fecha'  AND E.ESTADO_RESERVA = 'V' AND E.ID_CURSO = $curso) AS DISP
		FROM
		PERSONA A,
		RESERVA_CUPO_CLASE B,
		HORARIO C,
		PROFESOR D
		WHERE A.RUT_PERSONA = B.RUT_PERSONA AND B.ID_HORARIO= C.ID_HORARIO AND C.ID_PROFESOR = D.ID_PROFESOR AND B.FECHA_RESERVA = '$fecha' AND B.ID_CURSO = $curso AND C.HR_FIN >= '$hora' ");
		$reservas = $select->fetchAll();
		return $reservas;
	}
	
	public static function buscaProfes(){
		$db=Db::getConnect();
		$profesL;
		$select=$db->query("SELECT ID_PROFESOR, NOM_PROFESOR FROM profesor ");
		$profesL = $select->fetchAll();
		return  $profesL;  
	}
	
	public static function buscaAlumnos($dato){
		$db=Db::getConnect();
		$alumnos;
		$select=$db->query("SELECT  
								A.RUT_PERSONA AS RUT,
								CONCAT(A.NOMBRE_PERSONA, ' ', A.AP_PATERNO_PERSONA, ' ', A.AP_MATERNO_PERSONA) AS NOMBRE 
							from 
								PERSONA A,
								PERSONA_PERFIL B,
								HORARIO_ALUMNO C,
								HORARIO D
							WHERE 
								A.RUT_PERSONA = B.RUT_PERSONA AND
								B.ID_PERFIL = 3 AND
								A.RUT_PERSONA = C.RUT_PERSONA AND
								C.ID_HORARIO = D. ID_HORARIO AND
								D.ID_CURSO = $dato
								");
		$alumnos = $select->fetchAll();
		return  $alumnos;  
	}
	
	public static function guardarBoleta($nrBoleta,$cantClas,$msPag,$alSel,$cursoSel){
		$db=Db::getConnect();
		$insert=$db->prepare("INSERT INTO boleta_alumno VALUES ($alSel,$cursoSel,$nrBoleta,$cantClas,'$msPag')");
		$insert->execute();		
	}
	
	public static function validaBoleta($msPag,$alSel,$cursoSel){
		$db=Db::getConnect();
		$valBol;
		$select=$db->query("SELECT COUNT(NR_BOLETA) AS CANTIDAD FROM boleta_alumno WHERE RUT_PERSONA = $alSel AND ID_CURSO = $cursoSel AND MES_PAGO = '$msPag'");
		$valBol = $select->fetchAll();
		return $valBol;		
	}
	
	public static function existeUsuario($uss,$pasw){
		$db=Db::getConnect();
		$valUsuario;
		$select=$db->query("SELECT count(id_perfil) FROM persona_perfil where RUT_PERSONA = $uss and CONTRASENA = '$pasw'");
		$valUsuario = $select->fetchAll();
		return $valUsuario;		
	}
	
	public static function obtPerfil($ussuario,$pasword){
		$db=Db::getConnect();
		$perfil;
		$select=$db->query("SELECT id_perfil FROM persona_perfil where RUT_PERSONA = $ussuario and CONTRASENA = '$pasword'");
		$perfil = $select->fetchAll();
		return $perfil;		
	}
	
	public static function buscaHoras($alumno,$curso){
		$db=Db::getConnect();
		$valHoras;
		$select=$db->query("SELECT date_format(FECHA_RESERVA, '%d-%m-%Y') FECHA_RESERVA FROM reserva_cupo_clase where RUT_PERSONA = $alumno and ID_CURSO = $curso and month(curdate()) = month(FECHA_RESERVA) and year(curdate()) = year(FECHA_RESERVA)");
		$valHoras = $select->fetchAll();
		return $valHoras;		
	}
	
	public static function buscaDetHras($idReserva){
		$db=Db::getConnect();
		$valHoras;
		$select=$db->query("SELECT c.rut_persona, concat (nombre_persona, ' ', ap_paterno_persona, ' ', ap_materno_persona) nombre FROM reserva_cupo_clase b , persona c where c.RUT_PERSONA = b.RUT_PERSONA and b.id_reserva = $idReserva");
		$valHoras = $select->fetchAll();
		return $valHoras;		
	}
	
	public static function buscaProfess($curso1){
		$db=Db::getConnect();
		$profesO;
		$select=$db->query("SELECT ID_PROFESOR, NOM_PROFESOR FROM profesor WHERE ID_CURSO=$curso1");
		$select->bindValue('curso1',$curso1);
		$profesO = $select->fetchAll();
		return  $profesO;  
	}
	
	public static function buscaClasesDisponiblesxCurso($dato){
		$db=Db::getConnect();
		$clasesDisp;
		$select=$db->query("SELECT ID_HORARIO, HR_INICIO, HR_FIN, LUNES, MARTES, MIERCOLES, JUEVES, VIERNES, SABADO, DOMINGO FROM horario WHERE ESTADO_HORARIO = 'A' AND ID_PROFESOR = 0 AND ID_CURSO=$dato");
		$clasesDisp = $select->fetchAll();		
		return  $clasesDisp;
		
	}
	
	public static function buscaClasesTomadasxProfe($dato){
		$db=Db::getConnect();
		$clasesDispxProfe;
		$select=$db->query("select id_horario ,HR_INICIO, HR_FIN from horario where ID_HORARIO in (select id_horario from horario_profesor where id_profesor = $dato)");
		$clasesDispxProfe = $select->fetchAll();		
		return  $clasesDispxProfe;
		
	}
	
	public static function buscaClasesDisponibles(){
		$db=Db::getConnect();
		$clasesDisp;
		$select=$db->query("SELECT ID_HORARIO, HR_INICIO, HR_FIN, LUNES, MARTES, MIERCOLES, JUEVES, VIERNES, SABADO, DOMINGO FROM horario WHERE ESTADO_HORARIO = 'A' AND ID_PROFESOR = 0");
		$clasesDisp = $select->fetchAll();		
		return  $clasesDisp;
	}
	
	public static function actualizaHorario($idHora,$id_curso,$id_profesor){
		$db=Db::getConnect();
		$update=$db->prepare("UPDATE horario SET ID_PROFESOR=$id_profesor WHERE ID_HORARIO=$idHora AND ID_CURSO=$id_curso");
		$update->execute();
	}

}

?>