<template>
  <web-layout>
    <div class="card">
      <div class="card-body">
        <h3>Carrito de compras</h3>
        <cart />
      </div>
    </div>
  </web-layout>
</template>

<script>
import WebLayout from "@/Layouts/WebLayout";
import Cart from "@/Fragment/Cart";

export default {
  components: {
    WebLayout,
    Cart,
  },
};
</script>