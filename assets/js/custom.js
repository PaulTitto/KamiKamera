

    
    

    function cekStok(qty, inx){
      switch(inx){
        case 1 :{
            var tersedia1=document.getElementById('tersedia1').value;
            if (qty>tersedia1) {
              alert('Stok Hanya Tersedia '+tersedia1+' unit');
              document.getElementById('qty1').value='';
            }
            break;
        }
        case 2 :{
            var tersedia2=document.getElementById('tersedia2').value;
            if (qty>tersedia2) {
              alert('Stok Hanya Tersedia '+tersedia2+' unit');
              document.getElementById('qty2').value='';
            }
            break;
        }
        case 3 :{
            var tersedia3=document.getElementById('tersedia3').value;
            if (qty>tersedia3) {
              alert('Stok Hanya Tersedia '+tersedia3+' unit');
              document.getElementById('qty3').value='';
            }
            break;
        }
        case 4 :{
            var tersedia4=document.getElementById('tersedia4').value;
            if (qty>tersedia4) {
              alert('Stok Hanya Tersedia '+tersedia4+' unit');
              document.getElementById('qty4').value='';
            }
            break;
        }
        case 5 :{
            var tersedia5=document.getElementById('tersedia5').value;
            if (qty>tersedia5) {
              alert('Stok Hanya Tersedia '+tersedia5+' unit');
              document.getElementById('qty5').value='';
            }
            break;
        }
      }
    }



    $(document).ready(function() {
      var max_fields      = 10; //maximum input boxes allowed
      var wrapper       = $(".input_fields_wrap"); //Fields wrapper
      var add_button      = $(".add_field_button"); //Add button ID
      
      var x = 1; //initlal text box count
      $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
          x++; //text box increment
          $(wrapper).append('<div class="tambah'+x+'"><div class="row"><div class="col-lg-6 col-sm-12"><div class="form-group"><label>Nama Barang</label><input type="hidden" name="idBarang[]" id="idBarang'+x+'"><input type="hidden" id="tersedia'+x+'"><select name="kode" name="barang[]" class="form-control" style="box-shadow: inset 0 -1px 0 #ddd;" onchange="prosesBarang(this.value , '+x+')" ><option value="" hidden>--Pilih Barang--</option><?php
                              $sql = mysql_query("SELECT * FROM tb_barang");
                              $dataBrg = "var dtbrg = new Array();\n";
                              while ($res=mysql_fetch_array($sql)) {
                              $nama=$res ['nama_barang']." (".$res['qty']." unit)";
                              $dataBrg .= " dtbrg ['" . $res['id_barang']. "'] = {namaBarang:'" .$nama. "',hargaSewa:'" . $res ['harga_sewa']. "', qty:'" .$res ['qty']."'};\n";?><option value="<?php echo $res['id_barang']?>"><?=$nama;?></option><?php
                              }
                           ?></select></div></div><div class="col-lg-3 col-sm-12"><div class="form-group"><label>Harga (per Hari)</label><input type="text" name="harga[]" id="harga'+x+'" value="0" class="form-control" readonly></div></div><div class="col-lg-2 col-sm-12"><div class="form-group"><label>Qty</label><input type="number" name="qty[]" id="qty'+x+'" onkeyup="cekStok(this.value, '+x+')" style="box-shadow: inset 0 -1px 0 #ddd;" class="form-control"></div></div><div class="col-lg-1"><label>&nbsp;</label><button type="button" class="btn btn-sm btn-danger form-control remove_field"><i class="far fa-window-close fa-2x"></i></button></div></div></div>');
          //$(wrapper).append('<div><input type="text" value="'+x+'" name="mytext[]"/><a href="#" class="remove_field" >Remove</a></div>'); //add input box
        }
      });
      
      $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $('.tambah'+x+'').remove(); x--;
      })
    });