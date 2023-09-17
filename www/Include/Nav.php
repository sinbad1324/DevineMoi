<nav  class="" id="Navigation" >
     <div>
          <a href="MonCompte.php">Acceuil</a><br>
          <a href="GameSetting.php">Setting Game</a><br>
          <a href="Contact.php">Contact</a><br>
          <a href="JoinTheGame.php">Join Game</a><br>
     </div>
</nav>
<button id="NavBtn">Open Nav</button>
<style>
    #NavBtn{
        z-index: 1;
        display: inline-block;
        background-color: rgb(53, 95, 193);
        padding: 10px 20px;
        position: relative;
        bottom: 1095px;
        left: 209px;
        border: none;
        cursor: pointer;
        font-size: 25px;
        color: white;

    }
    nav{
    z-index: 1;
    background-color: rgb(53, 95, 193);
      width: 300px;
      height: 1000px;
      position: relative;
      top: 59px;
      opacity: 0;
      visibility: hidden;

    }
    nav div {
        z-index: 1;
    }

    nav div a{
        color:#fff ;
        margin-top: 1px;
        margin-left: 10px;
        margin-right: 10px;

        text-decoration: none;
        font-size : 20px;
        display: block;
        position: relative;
        top:10px;
        border: solid  black 1px ;
        padding: 5px 10px;
    }
    
  
    nav.NavMove{
        animation: MoveNav ease forwards  3s;
    }

    nav.NavBack{
        animation: BackNav ease forwards  3s;
    }

    @keyframes MoveNav {
        0% {
            transform: translateX(-600px);
        }
        90% { transform: translateX(10px); }
        100% { transform: translateX(20px); 
            opacity: 1;       visibility: visible;

        }

    }
    @keyframes BackNav {
        0% {
            transform: translateX(20px);
        }
        10% { transform: translateX(-10px); }
        100% { transform: translateX(-600px);   visibility: hidden;   opacity: 0;}  
  }
</style>

<script>
 const button34 = document.getElementById('NavBtn');
const div234 = document.getElementById('Navigation');

button34.addEventListener('click', function () {
    if (div234.classList.contains('NavMove')) {
        div234.classList.remove('NavMove');
        div234.classList.add('NavBack');
    } else {
        div234.classList.remove('NavBack');
        div234.classList.add('NavMove');
    }
});

</script>
