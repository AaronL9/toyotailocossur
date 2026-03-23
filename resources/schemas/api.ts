// src/schemas/api.ts
import { z } from 'zod';

export const PostResponseSchema = z.object({
  message: z.string(),
  csrf_token: z.string(),
  errors: z.nullable(z.record(z.string(), z.string())),
});

export type PostResponse = z.infer<typeof PostResponseSchema>;