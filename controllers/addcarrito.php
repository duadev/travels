<?php
session_start();
extract($_REQUEST);
//$id=$_GET['id'],$nom=$_POST['nom']
require('conexion.php');
if(!isset($cantidad)){$cantidad=1;}
$sql="select * from productos where idProductos='$id'";
$pro=mysqli_query($conexion,$sql);
$fila=mysqli_fetch_array($pro);
//Validar si YA existe algun item en el carrito
if(isset($_SESSION['carro']))
{
	$carro=$_SESSION['carro'];
}
//Agregar el item seleccionado al carrito de compras
//Para ello usaremos una variable de tipo arreglo
//Luego la guardaremos en la variable de session llamada "carro"
$carro[md5($id)]=array('identificador'=>md5($id),
	'cantidad'=>$cantidad,
	'descripcion'=>$fila['descripcion'],
	'precio'=>$fila['precio'],
	'id'=>$id);

//Agregar o actualizar o crear el carrito
$_SESSION['carro']=$carro;
if(isset($ori)||$ori=='v')
{
	header('location:vercarrito.php');
}else
{
	header('location:productosClientes.php');
}
?>