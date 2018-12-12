<script>        
         var cantidad = 1;   //inicializa variables globales del script usado más adelante
         var producto = 1;
</script>
     
<body>     
  <div class="container" style="margin-left: 13%">
    <h2>Crear nueva orden</h2>
      <a href="<?php echo base_url();?>index.php/Ordenes/lista_ordenes" class="btn btn-default" style="margin-left: 70%">Lista de ordenes</a>
      <form id="form" name="form" action="<?=base_url()?>index.php/Ordenes/addOrden" method="POST">
        <label for="N_ORDEN">N° ORDEN</label><br>
        <input type="number" name="N_ORDEN" value="" min="0" max="9999999999" size="30" required/><br />
        <label for="FECHA_INGRESO">FECHA DE INGRESO</label><br>
        <input type="date" name="FECHA_INGRESO" value="<?php echo date("Y-m-d");?>" size="30" required/><br />
        <br>
        <label> UCC </label>
        <select style="display: block; width: 30%;" name="selectUCC" class="col s12 m6 l4 input-field">
        <?php foreach ($UCC as $k => $v): ?>
        <option type="input" value="<?php echo $v["ID_UCC"] ?>" required><?php echo $v["NOMBRE"] ?></option>
        <?php endforeach ?>

        </select>
        <br>
        <label for="Productos">Productos</label><br>
        <div id="seccionProductos"></div>
        <div id="total"></div>
        <div id="jsAux"></div>
        <body onload="clickButton()">
        <input type="button" name="editar" id="addItem" value="+ Agregar producto" class="btn btn-default " />
        <br>
        <br>
        <label>Finalizar orden</label>
        <br>
        <input type="submit" value="Finalizar orden" class="btn btn-default" "/>
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