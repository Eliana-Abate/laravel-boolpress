<template>
  <section id="pagination">
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li
          class="page-item"
          v-if="currentPage > 1"
          @click="$emit('onPageChange', currentPage - 1)"
        >
          <a class="page-link">Previous</a>
        </li>
        <li
          class="page-item"
          v-for="n in lastPage"
          :key="n"
          @click="$emit('onPageChange', n)"
          :class="{ active: currentPage === n }"
        >
          <a class="page-link"> {{ n }}</a>
        </li>
        <li
          class="page-item"
          v-if="currentPage < lastPage"
          @click="$emit('onPageChange', currentPage + 1)"
        >
          <a class="page-link">Next</a>
        </li>
      </ul>
    </nav>
  </section>
</template>

<script>
export default {
  name: "Pagination",
  props: ["currentPage", "lastPage"],
};
</script>

<style>
</style>