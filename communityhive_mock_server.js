import http from 'http'
import { consola } from 'consola'

const hostname = 'communityhive.lvh.me';
const port = 3000;

const server = http.createServer((req, res) => {
  const { headers, httpVersion, method, url, } = req;

  let body = [];
  req.on('data', function(chunk) {
    body.push(chunk)
  }).on('end', function() {
    consola.start('----- REQUEST -----')
    consola.info('Method: ' + method)
    consola.info('Endpoint: ' + url)
    consola.info('Body: ' + Buffer.concat(body).toString())

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
        consola.error(new Error('Path not found for endpoint: ' + url))
        res.end('Path not found...')
        break;
    }
  })
}).on('error', function(error) {
  consola.error(error)
}).listen(port, hostname, () => {
  consola.ready('Community Hive Mock Server running...')
});