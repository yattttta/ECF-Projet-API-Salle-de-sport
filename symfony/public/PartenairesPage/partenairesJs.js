$(function() {

    const recherche = document.querySelector('input[type=search]')  
      
    recherche.addEventListener('keyup', function() {
        if(document.getElementById('ville').value == "") {
            document.getElementById('result').style.visibility = "hidden"
        } else {    
            let xhr = new XMLHttpRequest
            xhr.onreadystatechange = function() {
                if(xhr.readyState == 4 && xhr.status == 200) {  
                    if(xhr.responseText == "") {
                        document.getElementById("result").style.visibility = "hidden"
                    } else {
                        document.getElementById("result").style.visibility = "visible"    
                        document.getElementById("result").innerHTML = xhr.responseText
                    }    
                } else {
                    document.getElementById("result").innerHTML = "En cours de chargement..."
                }                
            } 
            xhr.open("post", "contenu", true)
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded")
            xhr.send("ville=" + document.getElementById("ville").value)
        }    
    })

})
