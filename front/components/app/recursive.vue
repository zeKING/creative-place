<template>
  <li>
    <span v-if="arr.submenu && arr.submenu.length">
      <nuxt-link class="text-dark" :to="getLink(arr)">{{ title }}</nuxt-link>
      <i class="fa fa-angle-down" />
    </span>
    <nuxt-link
      v-else
      class="text-dark"
      :to="getLink(arr)"
    >
      {{ title }}
    </nuxt-link>
    <ul v-if="arr.submenu && arr.submenu.length">
      <Recursive
        v-for="(item, index) in arr.submenu"
        :key="index"
        :arr="item"
        :title="item.title"
      />
    </ul>
  </li>
</template>

<script>
export default {
  name: 'Recursive',
  props: {
    arr: {
      type: Object,
      default () {
        return {}
      }
    },
    title: {
      type: String,
      default: () => '/'
    }

  },
  data () {
    return {

    }
  },
  methods: {
    getLink (item) {
      if (item.link) {
        return '/' + item.link
      } else if (item.slug) {
        return '/static/' + item.slug
      } else {
        return '/'
      }
    }
  }
}
</script>

<style>
    li > ul {
      display:none;
      visibility: hidden;
      opacity: 0;
      transition: all 0.3s ease-in-out;
      z-index: 998;
    }
    li > ul li:not(:last-child) {
      margin: 0 0 10px 0;
    }

    li:hover > ul {
      display:block;
      visibility: visible;
      opacity: 1;
      position: absolute;
      min-width: 200px;
      padding: 8px 0 8px 16px;
      background-color: #f07810;
    }
    li:hover > ul span  {
      padding: 0 16px 0 0;
    }

    li:hover > ul  li a {
      color: #fff !important;
    }
    li:hover > ul  li span {
      display: flex;
      justify-content: space-between;
    }
    li:hover > ul ul {
      left: 100%;
      top: 0;
    }
    li > ul li i {
      color: #fff !important;
      transform: rotate(270deg);
    }
    li > ul:hover li i {
      color: #fff !important;
    }
    </style>
