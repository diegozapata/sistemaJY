<script>        
         var cantidad = 1;   //inicializa variables globales del script usado más adelante
         var producto = 1;
</script>
     
<body>     
  <div class="container" style="margin-left: 13%">
    <h2>Crear nueva venta</h2>
      <a href="<?php echo base_url();?>index.php/Ventas/lista_ventas" class="btn btn-default" style="margin-left: 70%">Lista de ventas</a>
      <form id="form" name="form" action="<?=base_url()?>index.php/Ventas/addVenta" method="POST">
        <label for="N_BOLETA">N° BOLETA</label><br>
        <input type="number" name="N_BOLETA" value="" min="0" max="9999999999" size="30" required/><br />
        <label for="FECHA_INGRESO">FECHA DE INGRESO</label><br>
        <input type="date" name="FECHA_INGRESO" value="<?php echo date("Y-m-d");?>" size="30" required/><br />
        <br>
        <label>Tipo de venta</label>
            <select class="browser-default select-producto" id="selectVenta"name="selectVenta" style="width:40%">
                <option  type ="input" value="0">Normal</option>
                <option  type ="input" value="1">Transbank</option>
               
         </select><br>
        <label for="Productos">Productos</label><br>
        <div id="seccionProductos"></div>
        <label>Total:</label>
        <div id="total"></div>
        <div id="jsAux"></div>
        <body onload="clickButton()">
        <input type="button" name="editar" id="addItem" value="+ Agregar producto" class="btn btn-default" style="margin-left: 70%; width: 20%" />
        <br>
        <br>
        <label style="margin-left: 70%">Finalizar venta</label>
        <br>
        <input type="submit" value="Finalizar venta" class="btn btn-default" style="margin-left: 70%;width: 20%; display: block;"/>
      </form>
 
  </div>

</body>

<script type="text/javascript">
  function clickButton(){
    document.getElementById('addItem').click()
  }
</script>

<script type="text/javascript">
  $("#addItem").on("click", function(event){
    var productos = <?php echo json_encode($productos) ?>;
    var tpl = "";
   
    tpl += "<div class=\"row newProduct\" ><div class=\"col s12 m6 l4\"><select class=\"browser-default select-producto\" name=\""+producto+"\"+x id=\"producto\"+x value=\""+productos.ID_PRODUCTO+"\">";
    
    for(var i = 0; i < productos.length; i++){
      
      tpl += "<option id=\"prod"+productos[i].ID_PRODUCTO+"\" value=\""+productos[i].ID_PRODUCTO+"\" valor=\""+productos[i].PRECIO_V+"\" data-valor=\""+productos[i].PRECIO_V+"\">"+productos[i].NOMBRE+"</option>";
    
    }
    
    tpl += "</select></div><div class=\"col s12 m6 l4 input-field\"><input type=\"number\" class=\"valor\" min=\"0\"name=\"cantidad"+cantidad+"\" style=\"width:20%\"><label for=\"\">Cantidad</label></div></div>";
    
    cantidad++;
    producto++;
   
    $("#seccionProductos").append(tpl);

    script = '<script>var total = 0; $(".valor").on("keyup", function(e){';
    script += 'var largo = ($(".newProduct").length); total = 0;' ;
    script += '$.each($(".newProduct"), function( index, elemento ) {';
    script += 'var id = $(elemento).children("div").children("select").val();';
    script += 'total += parseInt($(elemento).children("div").children(".valor").val())*parseInt($("#prod"+id).data("valor"));';
    script += '}); $("#total").html(total); });';
    script += '\n';
    script += '$(".select-producto").on("change", function(e){';
    script += 'var largo = ($(".newProduct").length); total = 0;' ;
    script += '$.each($(".newProduct"), function( index, elemento ) {';
    script += 'var id = $(elemento).children("div").children("select").val();';
    script += 'total += parseInt($(elemento).children("div").children(".valor").val())*parseInt($("#prod"+id).data("valor"));';
    script += '}); $("#total").html(total); })<\/script>';
    
    $("#jsAux").html(script);
    

  });
   

</script>