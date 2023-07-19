<template>
  <div id="app">
    <div class="aselect" :data-value="value" :data-list="list">
      <div class="selector" @click="toggle()">
        <div class="label">
          <img class="icon" :src="selected?.url" alt="icon">
        </div>
        <!-- <div class="arrow" :class="{ expanded : visible }" /> -->
        <div :class="{ hidden : !visible, visible }">
          <ul>
            <li v-for="(item, i) in list" :key="i" :class="{ current : item === value }" @click="select(item)">
              <img class="icon" :src="item.url" alt="">
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Aselect',
  props: {
    list: {
      type: Array,
      required: true
    },
    defaultSelected: {
      type: Object,
      default: () => {}
    }
  },
  data () {
    return {
      value: 'Select a Fruit',
      selected: null,
      visible: false
    }
  },
  mounted () {
    if (this.defaultSelected) { this.selected = this.defaultSelected }
  },
  methods: {
    toggle () {
      this.visible = !this.visible
    },
    select (option) {
      this.selected = option
      this.$emit('select', option)
    }
  }
}
</script>

<style scoped>
  @import url('https://fonts.googleapis.com/css?family=Mogra|Roboto');

h1 {
  color: #f9f9f9;
  text-align: center;
  font-size: 36px;
  line-height: 1;
  font-weight: 300;
  letter-spacing: 3px;
  text-transform: uppercase;
  font-family: "Mogra";
  margin-bottom: 0;
  text-shadow: 3px 4px 0px rgba(0, 0, 0, 0.3);
}
.aselect {
  width: 100%;
  margin-top: 5px;
  /* margin: 20px auto; */
}
.aselect .selector {
  border: 1px solid gainsboro;
  background: #F8F8F8;
  position: relative;
  z-index: 1;
}
.aselect .selector .arrow {
  position: absolute;
  right: 10px;
  top: 40%;
  width: 0;
  height: 0;
  border-left: 7px solid transparent;
  border-right: 7px solid transparent;
  border-top: 10px solid #888;
  transform: rotateZ(0deg) translateY(0px);
  transition-duration: 0.3s;
  transition-timing-function: cubic-bezier(0.59, 1.39, 0.37, 1.01);
}
.aselect .selector .expanded {
  transform: rotateZ(180deg) translateY(2px);
}
.aselect .selector .label {
  display: block;
  padding: 12px;
  font-size: 16px;
  color: #888;
}
.aselect ul {
  width: 100%;
  list-style-type: none;
  padding: 0;
  margin: 0;
  font-size: 16px;
  border: 1px solid gainsboro;
  position: absolute;
  z-index: 1;
  background: #fff;
}
.aselect li {
  padding: 12px;
  color: #666;
}
.aselect li:hover {
  color: white;
  background: seagreen;
}
.aselect .current {
  background: #eaeaea;
}
.aselect .hidden {
  visibility: hidden;
}
.aselect .visible {
  visibility: visible;
}

</style>
