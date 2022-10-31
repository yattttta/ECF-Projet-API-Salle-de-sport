$(function() {
    
    const test = document.querySelector('input[type=search]')
    let xhr = new XMLHttpRequest

    test.addEventListener('input', function() {
        if (document.getElementById("mot").value == "") {
            document.getElementById("sugg").style.visibility = "hidden"
        } else {
            xhr.onreadystatechange = function() {
                if(xhr.readyState == 4 && xhr.status == 200) {
                    if(xhr.responseText == "") {
                        document.getElementById("sugg").style.visibility = "hidden"
                    } else {
                        document.getElementById("sugg").style.visibility = "visible"
                        document.getElementById("sugg").innerHTML = xhr.responseText
                    }                   
                } else {
                    document.getElementById("sugg").innerHTML = "En cours de chargement..."
                }                
            }
            xhr.open("post", "contenu", true)
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded")
            xhr.send("mot=" + document.getElementById("mot").value)
        }    
    })

})

