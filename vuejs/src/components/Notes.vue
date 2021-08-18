<template>
  <div class="tc-notes-wrapper">
    <add-new-button @addNote="addNote"/>
    <div class="tc-notes">
      <note v-for="(note, index) in notes" :key="index" :note="note" @deleteNote="deleteNote" @noteUpdated="noteUpdated"/>
    </div>
  </div>
</template>

<script>
import AddNewButton from "./AddNewButton";
import Note from "./Note";
import httpClient from "../services/http.service";
import notesService from "../services/notes.service";

export default {
  name: "Notes",
  components: {Note, AddNewButton},
  data()
  {
    return {
        notes: []
    }
  },
  methods: {
    async addNote(){
      const {status, data} = await notesService.create({title: '', body: ''});
      if (status === 201) {
        this.notes.unshift(data);
      }
    },
    async deleteNote(note){
      const {status} = await notesService.delete(note.id);
      if (status === 204) {
        this.notes.splice(this.notes.indexOf(note), 1);
      }
    },
    async noteUpdated(note){
      const response = await notesService.update(note);
    }
  },
  async beforeMount() {
    const {status, data} = await notesService.get();
    if (status === 200) {
      this.notes = data;
    }
  }
}
</script>

<style lang="scss" scoped>
  .tc-notes-wrapper
  {
    padding: 30px;
    .tc-notes
    {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      margin: 0 auto;
    }
  }
</style>