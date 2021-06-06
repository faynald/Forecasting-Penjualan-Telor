function kategoriOnClick(kategori){
    text = document.getElementById(kategori);
    document.getElementById("dropdownLabel").innerHTML = text.innerHTML;
}

function warningOnChange(namaWarning,valueInput){
    if (valueInput != ""){
        document.getElementById(namaWarning).style.display = 'none';
    }else{
        document.getElementById(namaWarning).style.display = 'block';
    }
}

function submitEditData(){
    var myModal = new bootstrap.Modal(document.getElementById("editdata"), {});
    inputTahun = document.getElementById("inputTahun").value;
    inputBulan = document.getElementById("selectBulan").value;
    inputAyamKampung = document.getElementById("inputAyamKampung").value;
    inputAyamKota = document.getElementById("inputAyamKota").value;
    document.getElementById("labelTahunModal").innerHTML = inputTahun;
    document.getElementById("labelBulanModal").innerHTML = inputBulan;
    document.getElementById("labelAyamKampungModal").innerHTML = inputAyamKampung;
    document.getElementById("labelAyamKotaModal").innerHTML = inputAyamKota;
    // mengubah nilai dari input yang tersembunyi/hidden
    document.getElementById("hiddenTahunModal").value = inputTahun;
    document.getElementById("hiddenBulanModal").value = inputBulan;
    document.getElementById("hiddenAyamKampungModal").value = inputAyamKampung;
    document.getElementById("hiddenAyamKotaModal").value = inputAyamKota;
    if(inputAyamKampung != "" && inputAyamKota != ""){
        myModal.show();
    }else if(inputAyamKampung == ""){
        document.getElementById("warningInputAyamKampung").style.display = 'block';
    }else if(inputAyamKota == ""){
        document.getElementById("warningInputAyamKota").style.display = 'block';
    }
}
