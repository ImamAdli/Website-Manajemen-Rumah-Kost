$(document).ready(function () {
	
$(".ts-sidebar-menu li a").each(function () {
	if ($(this).next().length > 0) {
		$(this).addClass("parent");
	};
})
var menux = $('.ts-sidebar-menu li a.parent');
$('<div class="more"><i class="fa fa-angle-down"></i></div>').insertBefore(menux);
$('.more').click(function () {
	$(this).parent('li').toggleClass('open');
});
$('.parent').click(function (e) {
	e.preventDefault();
	$(this).parent('li').toggleClass('open');
});
$('.menu-btn').click(function () {
	$('nav.ts-sidebar').toggleClass('menu-open');
});
	
	
	$('#zctb').DataTable();
	
	
	$("#input-43").fileinput({
	showPreview: false,
	allowedFileExtensions: ["zip", "rar", "gz", "tgz"],
	elErrorContainer: "#errorBlock43"
		// you can configure `msgErrorClass` and `msgInvalidFileExtension` as well
});
});

//untuk style dan drop photo css
const dropContainer = document.getElementById("dropcontainer")
const fileInput = document.getElementById("file") // Perbaikan di sini

dropContainer.addEventListener("dragover", (e) => {
	// prevent default to allow drop
	e.preventDefault()
}, false)

dropContainer.addEventListener("dragenter", () => {
	dropContainer.classList.add("drag-active")
})

dropContainer.addEventListener("dragleave", () => {
	dropContainer.classList.remove("drag-active")
})

dropContainer.addEventListener("drop", (e) => {
	e.preventDefault()
	dropContainer.classList.remove("drag-active")
	fileInput.files = e.dataTransfer.files
})

function showAdminForm() {
	document.getElementById('pemilikKostForm').classList.add('hidden');
	document.getElementById('adminForm').classList.remove('hidden');
	document.getElementById('loginTitle').innerText = 'Sign in Admin';
}

function showPemilikKostForm() {
	document.getElementById('adminForm').classList.add('hidden');
	document.getElementById('pemilikKostForm').classList.remove('hidden');
	document.getElementById('loginTitle').innerText = 'Sign in Pemilik Kost';
}

function previewImages() {
	var previewContainer = document.getElementById('preview-container');
	previewContainer.innerHTML = '';
	var files = document.getElementById('file').files;
	for (var i = 0; i < files.length; i++) {
		var file = files[i];
		if (file.type.startsWith('image/')) {
			var reader = new FileReader();
			reader.onload = function(e) {
				var img = document.createElement('img');
				img.src = e.target.result;
				previewContainer.appendChild(img);
			}
			reader.readAsDataURL(file);
		} else {
			alert('Hanya gambar yang diperbolehkan!');
			document.getElementById('file').value = '';
		}
	}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

