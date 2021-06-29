export default class dbhandler {

  async getSingleItem(url) {
    try {
      let req = await fetch(url, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
        }
      })
      let data = await req.json()
      console.log(data)
      return data
    } catch (error) {
      console.log('DB ERROR:')
      console.log(error)
      alert('There was a problem loading the data\nmake sure you searched for the correct licenseplate')
    }
  }

  async readSearch(url) {
    try {
      let req = await fetch(url)
      let data = await req.json()
      return data
    } catch (error) {
      console.log('DB ERROR:')
      console.log(error)
      alert('There was a problem loading the data\nmake sure you searched for the correct licenseplate')
    }
  }

}
