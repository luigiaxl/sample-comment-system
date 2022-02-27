import axios from "axios";
import { defineStore } from "pinia";

export const useCommentsStore = defineStore('comments', {
  state: () => ({
    comments: []
  }),

  actions: {
    /**
     * Set initial list of comments
     * 
     * @param comments an array of comments
     */
    setComments (comments) {
      this.comments = comments
    },

    /**
     * Add one comment at the beginning of the list
     * 
     * @param comment a comment object
     */
    prependComment (comment) {
      this.comments.splice(0, 0, comment)
    },

    /**
     * Fetch list of comments from server.
     * Save list to the store.
     */
    getComments () {
      const uri = '/api/comments';

      axios.get(uri)
        .then(result => this.setComments(result.data))
    },

    /**
     * Submit new comment to server.
     * Add new comment to the store.
     * 
     * @param newComment object containing new comment details
     */
    postComment (newComment) {
      const uri = '/api/comments';

      axios.post(uri, comment)
        .then(result => this.prependComment(result.data))
    }
  }
})