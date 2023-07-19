export default async function ({ redirect, $cookies }) {
  const user = await $cookies.get('auth._token.local')
  console.log(user)
  if (!user) {
    redirect('/login')
  }
}
