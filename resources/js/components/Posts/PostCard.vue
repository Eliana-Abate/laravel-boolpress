<template>
  <section id="post-card" class="py-3">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">{{ post.title }}</h5>
      </div>
      <div class="card-body">
        <p>{{ post.content }}</p>
        <time>{{ post.created_at }}</time>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "PostCard",
  props: ["post"],
};
</script>

<style>
</style>