// function openNav() {
//     document.getElementById("mySidenav").style.width = "250px";
// }
//
// function closeNav() {
//     document.getElementById("mySidenav").style.width = "0";
// }

// function myAccFunc() {
//     var x = document.getElementById("demoAcc");
//     if (x.className.indexOf("w3-show") == -1) {
//         x.className += " w3-show";
//         x.previousElementSibling.className += " w3-green";
//     } else {
//         x.className = x.className.replace(" w3-show", "");
//         x.previousElementSibling.className =
//             x.previousElementSibling.className.replace(" w3-green", "");
//     }


function w3_open() {
    document.getElementById("main").style.marginLeft = "20%";
    document.getElementById("mySidebar").style.width = "20%";
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
    document.getElementById("main").style.marginLeft = "0%";
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("openNav").style.display = "inline-block";
}

// <script type="text/javascript">
    function printChecked(){
        var items=document.getElementsByName('filter');
        var selectedItems="";
        for(var i=0; i<items.length; i++){
            if(items[i].type=='checkbox' && items[i].checked==true)
                selectedItems+=items[i].value+"\n";
        }

        // $.post("/",
        //     {
        //         value : selectedItems
        //     },
        //     function(data, status){
        //         alert('value stored');
        //     });
        alert(selectedItems);
    }
    // </script>
