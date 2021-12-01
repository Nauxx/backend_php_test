document.addEventListener('DOMContentLoaded', () => {
  var es; // EventSource

  const percentage = document.getElementById('percentage');
  const urlCounter = document.getElementById('urlCounter');
  const urlCurrent = document.getElementById('urlCurrent');

  const input = document.getElementById('url-input');
  const button = document.getElementById('button');

  button.addEventListener('click', startSaving);

  function startSaving() {
    button.removeEventListener('click', startSaving);
    button.classList.toggle('btn--inactive');
    let url = input.value;
    //console.log(url);
    es = new EventSource(`backend.php?website=${url}`);

    es.addEventListener('message', function (e) {
      var result = JSON.parse(e.data);
      addLog(result.url, result.current, result.total);
      //console.log('last event id:' + e.lastEventId);
      if (e.lastEventId == 'CLOSE') {
        percentage.innerHTML = 'Done';
        urlCounter.innerHTML = '-';
        urlCurrent.innerHTML = '-';
        input.value = '';
        es.close();
        button.addEventListener('click', startSaving);
        button.classList.toggle('btn--inactive');
      }
    });

    es.addEventListener('error', function (e) {
      //console.log(e);
      addLog('Error occurred');
      es.close();
    });
  }

  function addLog(url, current, total) {
    //console.log('current: ' + current);
    //console.log('total: ' + total);
    percentage.innerHTML = Math.round((current / total) * 100) + '%';
    urlCounter.innerHTML = `currently saving url ${current} of ${total}`;
    urlCurrent.innerHTML = url;
  }
});
