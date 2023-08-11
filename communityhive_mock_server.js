import http from 'http'

const hostname = 'communityhive.lvh.me';
const port = 3000;

const server = http.createServer((req, res) => {
  const { headers, httpVersion, method, url } = req;

  console.log('Request:')
  console.table({
    'method': method,
    'url': url
  })
  console.log('Headers:')
  console.table(headers)

  res.statusCode = 200;
  res.setHeader('Content-Type', 'application/json');

  switch (req.url) {
    case '/activate':
      // res.end(JSON.stringify({
      //   'hive_key': (Math.random() + 1).toString(36).substring(2),
      //   'hive_site_id': (Math.random() + 1).toString(36).substring(2)
      // }))
      res.end(JSON.stringify({
        'error': 'Community already activated',
      }))
      break;

    case '/subscribe':
      res.end(JSON.stringify({
        'redirect_url': 'https://www.google.com',
      }))
      break;

    case '/groupupdate':
      res.end(JSON.stringify({
        'message': 'okay',
      }))
      break;

    default:
      res.end('Path not found...')
      break;
  }
}).on('error', function(error) {
  console.log(error)
}).listen(port, hostname, () => {
  console.log('Community Hive Mock Server running...')
});