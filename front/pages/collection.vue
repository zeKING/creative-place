<template>
  <div>
    <CollectionMain class="home main-projects-page" />
    <AppGallery :images="images" />
  </div>
</template>

<script>
export default {
  data () {
    return {
      images: [
        {
          photo: require('~/assets/images/carsl.png'),
          title: 'test Title',
          name: 'test Name',
          age: 99
        },
        {
          photo: require('~/assets/images/carsl.png'),
          title: 'test Title',
          name: 'test Name',
          age: 99
        },
        {
          photo: require('~/assets/images/carsl.png'),
          title: 'test Title',
          name: 'test Name',
          age: 99
        },
        {
          photo: require('~/assets/images/carsl.png'),
          title: 'test Title',
          name: 'test Name',
          age: 99
        },
        {
          photo: require('~/assets/images/carsl.png'),
          title: 'test Title',
          name: 'test Name',
          age: 99
        }

      ]
    }
  }
}
</script>
