import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-color-picker2', IndexField)
  app.component('detail-color-picker2', DetailField)
  app.component('form-color-picker2', FormField)
})
