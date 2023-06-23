import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-google-map', IndexField)
  app.component('detail-google-map', DetailField)
  app.component('form-google-map', FormField)
})
