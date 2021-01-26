
	function isikecamatan(id){
		var field = $("#praktek_kecamatan"+id);
		field.html("<option value=''></option>");
		$.ajax({
			url : $('body').data('baseurl')+"c_public_function",
			data : {
				task : 'kecamatan'
			},
			type : 'POST', dataType : 'json'
		}).done(function(response){
			if(response){
				for(i=0;i<response.length;i++){
					var option = "<option value='"+response[i]['KECAMATAN_KODE']+"' ";
					option += " >"+response[i]['KECAMATAN_NAMA']+"</option>";
					field.append(option);
				}
			}
			
		});
	}
	function isisarana(id){
		var field = $("#sarana_nama"+id);
		//field.html("<option value=''></option>");
		$.ajax({
			url : $('body').data('baseurl')+"c_public_function",
			data : {
				task : 'sarana'
			},
			type : 'POST', dataType : 'json'
		}).done(function(response){
			if(response){
				for(i=0;i<response.length;i++){
					var option = "<option value='"+response[i]['SARANA_ID']+"' ";
					option += " >"+response[i]['SARANA_JENIS']+" - "+response[i]['SARANA_NAMA']+"</option>";
					field.append(option);
				}
			}
			
		});
	}
  
  //dynamic tempat form
  function pilihkecamatan(el){
	var value = $(el).val();
	var id = $(el).data().id;
	field = $("#praktek_kelurahan"+id);
	field.html("<option value=''>Loading</option>");
	$.ajax({
		url : $('body').data('baseurl')+"c_public_function",
		data : {
			task : 'kelurahan',
			id : value
		},
		type : 'POST', dataType : 'json'
	}).done(function(response){
		field.html("<option value=''></option>");
		if(response){
			for(i=0;i<response.length;i++){
				var option = "<option value='"+response[i]['KELURAHAN_KODE']+"' ";
				option += " >"+response[i]['KELURAHAN_NAMA']+"</option>";
				field.append(option);
			}
		}
	});
  }

  //normal form
  function getkelurahan(el){
	var value = $(el).val();
	var id = $(el).data().id;
	field = $("#kelurahan");
	field.html("<option value=''>Loading</option>");
	$.ajax({
		url : $('body').data('baseurl')+"c_public_function",
		data : {
			task : 'kelurahan',
			id : value
		},
		type : 'POST', dataType : 'json'
	}).done(function(response){
		field.html("<option value=''></option>");
		if(response){
			for(i=0;i<response.length;i++){
				var option = "<option value='"+response[i]['KELURAHAN_KODE']+"' ";
				option += " >"+response[i]['KELURAHAN_NAMA']+"</option>";
				field.append(option);
			}
		}
	});
  }

    