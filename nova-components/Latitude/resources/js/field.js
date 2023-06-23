import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-latitude', IndexField)
  app.component('detail-latitude', DetailField)
  app.component('form-latitude', FormField)
})
