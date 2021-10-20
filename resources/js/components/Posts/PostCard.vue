<template>
  <section id="post-card" class="py-3">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">{{ post.title }}</h5>
      </div>
      <div class="card-body">
        <p>{{ post.content }}</p>
        <time>Pubblicato il: {{ getFormattedDate(post.created_at) }}</time>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "PostCard",
  props: ["post"],
  methods: {
    getFormattedDate(date) {
      const formattedDate = new Date();
      let day = formattedDate.getDate();
      let month = formattedDate.getMonth() + 1;
      const year = formattedDate.getFullYear();

      if (day < 10) day = "0" + day;
      if (month < 10) month = "0" + month;

      return `${day}-${month}-${year}`;
    },
  },
};
</script>

<style>
</style>