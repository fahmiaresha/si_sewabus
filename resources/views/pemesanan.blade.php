@extends('layout/main')


@section('container')

    <div class="hero-wrap hero-bread" style="background-image: url('asset/vegfoods/images/baground2.jpeg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span><span>Cart</span></p>
            <h1 class="mb-0 bread">Pemesanan</h1>
          </div>
        </div>
      </div>
	</div>
  </br>
  </br>

<section id="hero">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 order-1 order-lg-2 hero-img">
        <div class="kotak">
          <div class="row">
            <div class="col-md-12 text-center">
              <h1>Formulir Pemesanan Sewa Bus</h1>
              <p style="font-danger">* Harga sudah termasuk biaya bensin dan biaya sopir</p>
              <hr>
            </div>
        <div class="col-md-8 text-left">

            <form action="pemesanan_store" method="post" accept-charset="utf-8">
                    {{ csrf_field() }}
                    <!-- <input type="hidden" name="token_rahasia" value="72827582Uduagd86275gbdahgahgfa"> -->
                    <input type="hidden" name="STATUS_SEWA" value="Booking">
                    <!-- <input type="hidden" name="ID_PENGGUNA" value="{{Session::get('coba2')}}"> -->

                      <p class="alert alert-primary">
                        Isi data pemesanan Anda dengan lengkap dan benar.
                      </p>
                      <div class="form-group row">
                        <label class="col-sm-4 control-label text-right">Category Bus :</label>
                        <div class="col-sm-8">
                        <select name="ID_CATEGORY" class="form-control" id="ID_CATEGORY1" onchange="getHari()">
                                        @foreach($category_armada as $c)
                                       
                                        <option id="ID_CATEGORY1{{$c->ID_CATEGORY}}" value="{{$c->ID_CATEGORY}}" 
                                        data-hari="{{$c->ID_CATEGORY}}">{{$c->NAMA_CATEGORY}}</option>
                                       
                                        @endforeach                 
                                        </select>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 control-label text-right">Jumlah Hari :</label>
                        <div class="col-sm-8">
                        <select name="JUMLAH_HARI" class="form-control" id="JUMLAH_HARI1" onchange="getTujuan()">
                                      @foreach($pricelist_sewa_armada as $pr)
                                       
                                       <option id="JUMLAH_HARI1{{$pr->ID_HARI}}" value="{{$pr->ID_HARI}}" 
                                       data-tujuan="{{$pr->JUMLAH_HARI}}">{{$pr->ID_HARI}} Hari</option>
                                      
                                       @endforeach                 
                                       </select>
                                        <!-- <option selected="selected">-- Pilih Hari --</option>
                                                    <option value="1">1 Hari</option>
                                                    <option value="2">2 Hari</option>
                                                    <option value="3">3 Hari</option>
                                                    <option value="4">4 Hari</option>
                                                    <option value="5">5 Hari</option>
                                                    <option value="6">6 Hari</option>
                                                    <option value="7">7 Hari</option>
                                        </select> -->
                      </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 control-label text-right">Tujuan Bus :</label>
                        <div class="col-sm-8">
                        <select name="TUJUAN_SEWA" class="form-control" id="TUJUAN_SEWA1" onchange="getHarga()">
                                            @foreach($pricelist_sewa_armada as $pr)
                                        
                                            <option id="TUJUAN_SEWA1{{$pr->ID_PRICELIST}}" value="{{$pr->ID_PRICELIST}}" 
                                            data-pricelist="{{$pr->PRICELIST_SEWA}}">{{$pr->TUJUAN_SEWA}}</option>
                                        
                                            @endforeach                 
                                            </select>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 control-label text-right">Tanggal Sewa<span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                          <input id="tglsewa" type="date" name="TGL_SEWA_BUS" class="form-control tanggal">
                        </div>
                        <div class="col-sm-4">
                          <button id="btntujuan" type="button" name="submit" class="btn btn-primary btn-xs" onclick="getTujuanByDate()">
                            <i class="fa fa-save"></i>Choose Bus
                          </button>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-4 control-label text-right">Jam Jemput<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <input type="time" name="JAM_SEWA" class="form-control tanggal">
                        </div>
                      </div>

                      <!-- <div class="form-group row">
                        <label class="col-sm-4 control-label text-right">Tanggal Akhir Sewa<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <input type="date" name="TGL_AKHIR_SEWA" class="form-control tanggal">
                        </div>
                      </div> -->

                      <!-- <div class="form-group row">
                        <label class="col-sm-4 control-label text-right">Tanggal Akhir Sewa<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <input type="time" name="JAM_AKHIR_SEWA" class="form-control tanggal">
                        </div>
                      </div> -->

                      <div class="form-group row">
                        <label class="col-sm-4 control-label text-right">Nama Anda<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <input type="text" name="NAMA_CUSTOMER" class="form-control" placeholder="Nama Anda" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-4 control-label text-right">Nomor HP/Whatsapp <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <input type="number" name="TELEPHONE" class="form-control" placeholder="Nomor HP/Whatsapp" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-4 control-label text-right">Email <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <input type="email" name="EMAIL_CUSTOMER" class="form-control" 
                          placeholder="Email Anda" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-4 control-label text-right">Alamat Jemput <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <textarea name="ALAMAT" class="form-control" placeholder="Alamat"></textarea>
                        </div>
                      </div>
              
                 
             
          
                    <div class="col-md-12">
                      <!-- <img src="{{ url('asset/vegfoods/images/bismillah.jpg') }}" class="img img-thumbnail img-fluid" >   -->
                      <hr>
                        <p>Anda sudah melakukan pembayaran? Silahkan lakukan <a href="{{ url('konfirmasi_pembayaran') }}">Konfirmasi Pembayaran</a>.</p>
                      <hr>
                    </div>

                    <!-- <div class="clearfix" align="left">
                        <button type="button" name="submit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
                          <i class="fa fa-save"></i>Choose Armada
                        </button>
                    </div> -->
            
            <th>&nbsp;</th>
                    <table class="table table-bordered" id="keranjang">
                      <thead class="thead-light">
                            <tr class="text-center">
                              
                              <th>ID Category</th>
                              <th>Armada</th>
                              <th>Tujuan Sewa</th>
                              <th>Price</th>
                              <th>Quantity</th>
                              <th></th>
                              <th>Sub Total</th>
                              <th>&nbsp;</th>
                            </tr>
                        </thead>
                    </table>

            <br>
  
                      <div class="col-xl-12">
                        <div class="row mt-12 pt-3">
                          <div class="col-md-12 d-flex mb-12">
                            <div class="cart-detail cart-total p-3 p-md-4">
                              <h3 class="billing-heading mb-4">Cart Total</h3>
                              <p class="d-flex">
                                <span>Total Biaya Sewa</span>
                                <div class="col-sm-12 col-md-1">
                                  <label>Rp.</label><br>
                                </div>
                                <div class="col-sm-12 col-md-2">
                                  <label id="subtotal-val"></label><br>
                                </div>
                              </p>
                              <p class="d-flex">
                                <span>DP (25%)</span>
                                <div class="col-sm-12 col-md-1">
                                  <label>Rp.</label><br>
                                </div>
                                <div class="col-sm-12 col-md-2">
                                  <label id="dpbus"></label><br>
                                </div>
                              </p>
                              <hr>
                              <!-- <p class="d-flex total-price">
                                <span>Sisa Bayar</span>
                                <div class="col-sm-12 col-md-1">
                                  <label>Rp.</label><br>
                                </div>
                                <div class="col-sm-12 col-md-2"> -->
                                  <label id="total-val" type="hidden"></label><br>
                                <!-- </div>
                              </p> -->
                            </div>
                          </div>
                        </div>
                      </div>
	
                              <input type="hidden" name="idsewa" id="idsewa" value="">
                              <input type="hidden" name="sub" id="tot">
                              <input type="hidden" name="dpbus" id="depe">
                              <input type="hidden" name="sisa" id="sb">
                              <input type="hidden" name="durasi" id="durasi">
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              
                    <div class="form-group row" align="right">
                      <label class="col-sm-4 control-label"></label>
                      <div class="col-sm-8">
                        <div class="btn-group">
                          <button type="submit" class="btn btn-info btn-lg" value="submit">
                            <i class="fa fa-times"></i>Booking
                          </button>
                        </div>
                      </div>
                    </div>
            
                                      <!-- Modal -->
                                      <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="myModal">
                                        <div class="modal-dialog modal-xl">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h4 class="modal-title" id="myModalLabel">Choose Armada</h4>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                              <div class="modal-body">
                                                <!-- <div class="table-responsive"> -->
                                                    <table class="table table-striped">
                                                    <thead>
                                                      <tr role="row">
                                                        <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1">Armada</th>
                                                        <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1">Tujuan Sewa</th>
                                                        <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1">Price</th>
                                                        <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1">Jumlah Hari</th>
                                                        <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1">Jumlah Armada (Tersedia)</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody id="bodyprice">
                                                      
                                                    </tbody>
                                                  </table>
                                                <!-- </div> -->
                                              </div>
                                            </div>
                                        </div>
                                      <div>

                </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </br>
  </br>
           
</section>

<section class="ftco-section bg-light">

</section>

<script>

function getTgl() {
var today = new Date();
var day = today.getDate();
var month = today.getMonth()+1;
var year = today.getFullYear();
if(month < 10){
    month = '0'+month.toString();
}
if(day < 10){
  day = '0'+day.toString();
}
 var minToday = year+"-"+month+"-"+day;
 document.getElementById('tglsewa').setAttribute('min',minToday);
}

getTgl();

function getHari(){
      var har = document.getElementById('ID_CATEGORY1').value;
      $.ajax({
           url:"{{url('hari')}}",
            data:"days="+har,
           dataType: "json",
           type: "GET",
           success:function(response){
             $('#JUMLAH_HARI1').empty();
             $.each(response.data, function(key,item){
               $('#JUMLAH_HARI1').append('<option id="JUMLAH_HARI1'+item.ID_PRICELIST+'"  value"'+item.ID_CATEGORY+'" data-tujuan="'+item.JUMLAH_HARI+'">'+item.ID_HARI+'</option>');
             });
            }
       });
   }
   
   function getTujuan(){
    var cat = document.getElementById('ID_CATEGORY1').value;
       $.ajax({
           url:"{{url('tujuan')}}",
            data:"category="+cat,
           dataType: "json",
           type: "GET",
           success:function(response){
            // alert("Percoban");
                $('#TUJUAN_SEWA1').empty();
                 $.each(response.data,function(key,item){
                     $('#TUJUAN_SEWA1').append('<option id="TUJUAN_SEWA1'+item.ID_PRICELIST+'"  value"'+item.ID_HARI+'" data-pricelist="'+item.PRICELIST_SEWA+'">'+item.TUJUAN_SEWA+'</option>');
                 });
           }
       });
  }

  function getTujuanByDate(){
    var tgl = document.getElementById('tglsewa').value;
    var tuj = document.getElementById('TUJUAN_SEWA1').value;
    var cat1 = document.getElementById('ID_CATEGORY1').value;
    $.ajax({
      url:"{{url('tujuanbyfilter')}}",
      data: "tgl="+tgl+"&tuj="+tuj+"&cat1="+cat1,
      dataType: "json",
          type: "GET",
      success:function(response){
        $('#bodyprice').empty();
        $.each(response.data,function(key,item){
          $('#bodyprice').append('<tr role="row" class="odd" onclick="pilihBarang(\''+item.ID_PRICELIST+'\')" style="cursor:pointer"><td value="'+item.ID_CATEGORY+'">'+item.NAMA_CATEGORY+'</td><td>'+ item.TUJUAN_SEWA +'</td><td>'+item.PRICELIST_SEWA+'</td><td>'+item.JUMLAH_HARI+'</td><td>'+item.jmlbis+'</td></tr>');
       
    });
    $('#myModal').modal('show');
  }
    });
  }

var barang = <?php echo json_encode($pricelist_sewa_armada); ?>;
	// console.log(barang[0]["NAMA_CATEGORY"]);
  console.log("hasil barang");
  console.log(barang);

	var colnum=0;

	function getVal(event){
		if (event.keyCode === 13) {
			modal();
		}
	}

  // function getIndex(id){
  //   for(var i=0;i<barang.length;i++){
	// 		if(barang[i]["ID_PRICELIST"]==id){
	// 			console.log(barang[i]);
	// 			index=i;
	// 			break;
	// 		}
	// 	}
  // }

	function pilihBarang(id){
		var index;
		for(var i=0;i<barang.length;i++){
			if(barang[i]["ID_PRICELIST"]==id){
				console.log(barang[i]);
				index=i;
				break;
			}
		}
    var stokMax = barang[index]["jmlbis"];
    console.log("ssssssss");
    console.log(stokMax);
		$("#myModal").modal("hide");
    $("#btntujuan").show();

		var table = document.getElementById("keranjang");
		var row = table.insertRow(table.rows.length);
		row.setAttribute('id','col'+colnum);
		var id = 'col'+colnum;
		colnum++;

		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		var cell5 = row.insertCell(4);
		var cell6 = row.insertCell(5);
		var cell7 = row.insertCell(6);
		var cell8 = row.insertCell(7);
    //var cell9 = row.insertCell(8);
		
		console.log(index);
		cell1.innerHTML = '<input type="hidden" name="id['+barang[index]["ID_PRICELIST"]+']" value="'+barang[index]["ID_PRICELIST"]+'">'+barang[index]["ID_CATEGORY"];
		cell2.innerHTML = '<input type="hidden" name="cat['+barang[index]["ID_PRICELIST"]+']" value="'+barang[index]["ID_CATEGORY"]+'">'+barang[index]["NAMA_CATEGORY"];
		cell3.innerHTML = '<input type="hidden" name="tj['+barang[index]["ID_PRICELIST"]+']" value="'+barang[index]["TUJUAN_SEWA"]+'">'+barang[index]["TUJUAN_SEWA"];	
    
		cell4.innerHTML = '<input type="hidden" id="harga'+barang[index]["ID_PRICELIST"]+'" name="harga['+barang[index]["ID_PRICELIST"]+']" value="'+barang[index]["PRICELIST_SEWA"]+'">'+barang[index]["PRICELIST_SEWA"];
		cell5.innerHTML = '<input type="number" name="qty['+barang[index]["ID_PRICELIST"]+']" value="1" min="1" max='+stokMax+' oninput="recount(\''+barang[index]["ID_PRICELIST"]+'\')" id="qty'+barang[index]["ID_PRICELIST"]+'" style="background:secondary; border:none; text-align:left; width=100%">';	
    cell6.innerHTML = '<input class="discount" type="hidden" name="discount['+barang[index]["ID_PRICELIST"]+']" value="0" oninput="recount(\''+barang[index]["ID_PRICELIST"]+'\')" id="discount'+barang[index]["ID_PRICELIST"]+'" style="background:primary; border:none; text-align:left; width=100%" readonly>';	
		cell7.innerHTML = '<input type="hidden" class="subtotal" name="subtotal['+barang[index]["ID_PRICELIST"]+']" value="'+barang[index]["PRICELIST_SEWA"]+'" id="subtotal'+barang[index]["ID_PRICELIST"]+'"><span id="subtotalval'+barang[index]["ID_PRICELIST"]+'">'+barang[index]["PRICELIST_SEWA"]+'</span>';
    //cell8.innerHTML = '<input type="hidden" name="durasi['+barang[index]["ID_PRICELIST"]+']" value="'+barang[index]["JUMLAH_HARI"]+'">'+barang[index]["JUMLAH_HARI"];	
		cell8.innerHTML = '<button onclick="hapusEl(\''+id+'\')" class="btn btn-danger btn-block text-uppercase">X</button>';
    document.getElementById("durasi").value = barang[index]["JUMLAH_HARI"];
		total();
		
	}
	function lm(i){
		var min =  document.getElementById("qty"+i).value;
		if(min <= 1){

		}else{
		min--;
		document.getElementById("qty"+i).value = min;
		recount(i);
		}
	}
	function ln(i){
		var plus =  document.getElementById("qty"+i).value;
		console.log(plus);
		plus++;
		document.getElementById("qty"+i).value = plus;
		console.log(plus);
		recount(i);
	}

	function total(){
		var subtotals = document.getElementsByClassName("subtotal");
		var total = 0;
		for(var i=0; i<subtotals.length;++i){
			total += Number(subtotals[i].value); 
		}
		document.getElementById("subtotal-val").innerHTML = total;
		var dp = parseInt(25/100*total);
		document.getElementById("dpbus").innerHTML = dp;
		var sisabayar = parseInt(75/100*total);
        document.getElementById("total-val").innerHTML = sisabayar;
        document.getElementById("tot").value = total;
        document.getElementById("depe").value = dp;
        document.getElementById("sb").value = sisabayar;
	}

	function recount(id){
		var price = document.getElementById("harga"+id).value;
		var diskon = document.getElementById("discount"+id).value;
		var sembarang = document.getElementById("qty"+id).value;
     
		var lego = Number(price*sembarang)-diskon; 
		document.getElementById("subtotal"+id).value = lego;
		document.getElementById("subtotalval"+id).innerHTML = lego;
		total();
	}

	function modal(){
		$("#myModal").modal("show");
		document.getElementById("myText").value = "";
	}
	function hapusEl(idCol) {
    $("#btntujuan").show();
		document.getElementById(idCol).remove();
		total();
	}

function rupiah1(){
  var	number_string = bilangan.toString(),
	sisa 	= number_string.length % 3,
	rupiah 	= number_string.substr(0, sisa),
	ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
		
  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }

  // Cetak hasil
  document.write(rupiah);
}

</script>



@endsection