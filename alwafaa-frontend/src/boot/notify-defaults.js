import { Notify } from 'quasar'

Notify.setDefaults({
  position: 'top',
  progress: true,
  multiLine: true,
  timeout: 4000,
  textColor: 'white',
  actions: [{ icon: 'close', color: 'white' }]
})
// "async" is optional;
// more info on params: https://quasar.dev/quasar-cli/boot-files
export default async (/* { app, router, Vue ... } */) => {
  // something to do
}
