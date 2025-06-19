1. Add Slim logging.
2. Deploy MySQL HA cluster + backups using Chef or Ansible.
3. CI/CD for backend (GitHub Actions?).
4. CI/CD for frontend (AWS S3 + CloudFlare ?).
5. Add router to the React app.
   - Re-design main page.
7. Add authentication using JWT + add Google auth.
8. Add unit testing for backend.
9. Add unit testing for frontend.
10. Add integration tests for the API (include it to the CI pipeline).
11. Create data migration from the old app:
    - create data sync process (?) while working on the new app.
12. Add offline worker to the app (extra feature):
    - sync records added offline when user gets connection back (?).
13. Develop maintenance mode which can be enabled for the deployments (extra feature)
14. Add multi-language support on both: backend and frontend.
15. Design data encryption on the DB level using private users keys.