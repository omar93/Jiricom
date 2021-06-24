export default class dbhandler {

  async getSingleItem(url) {
    try {
      let req = await fetch(url)
      let data = await req.json()
      return data
    } catch (error) {
      alert('There was a problem loading the data\nmake sure you searched for the correct licenseplate')
    }
  }

}
