let form = document.querySelector('#form')

form.addEventListener('submit', (e)=>{
    e.preventDefault()
    console.log('submit')
    let data = new FormData(form)
    console.log(data)
    fetch('../server.php', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json'}, 
      body: JSON.stringify({name: 'michael'})})
})





/* var es;
 
function startTask() {

    es = new EventSource('../server.php');
     

    es.addEventListener('message', function(e) {
        var result = JSON.parse( e.data );

        document.getElementById('display').innerHTML = result
         
        addLog(result.message);       
         console.log(e.lastEventId)
        if(e.lastEventId == 'CLOSE') {
            addLog('Received CLOSE closing');
            es.close();
            var pBar = document.getElementById('progressor');
            pBar.value = pBar.max; //max out the progress bar
        }
        else {
            var pBar = document.getElementById('progressor');
            pBar.value = result.progress;
            var perc = document.getElementById('percentage');
            perc.innerHTML   = result.progress  + "%";
            perc.style.width = (Math.floor(pBar.clientWidth * (result.progress/100)) + 15) + 'px';
        }
    });
     
    es.addEventListener('error', function(e) {
        console.log(e)
        addLog('Error occurred');
        es.close();
    });
}
 
function stopTask() {
    es.close();
    addLog('Interrupted');
}
 
function addLog(message) {
    var r = document.getElementById('results');
    r.innerHTML += message + '<br>';
    r.scrollTop = r.scrollHeight;
} */