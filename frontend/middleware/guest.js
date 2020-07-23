export default function ({ $auth, store, redirect }) {
    if ($auth.$state.loggedIn) {
        return redirect('/')
    }
    // if (!process.server) {
    // }
}